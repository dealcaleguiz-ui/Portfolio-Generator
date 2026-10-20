<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Handles everything about a portfolio:
 * create, save, edit, delete, choose a template, and show the result.
 */
class PortfolioController extends Controller
{
    // Related tables saved together with a portfolio
    private const RELATIONS = ['educations', 'skills', 'projects', 'experiences', 'links'];

    // The three templates (file names in resources/views/templates)
    private const TEMPLATES = ['simple', 'modern', 'creative'];

    /* =========================================
       MANAGE PORTFOLIOS (list, create, edit, delete)
    ========================================= */

    public function index()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('portfolios.index', compact('portfolios'));
    }

    // Show the empty form for a new portfolio
    public function create()
    {
        return view('portfolios.create');
    }

    // Save a new portfolio to the database, then go choose a template
    public function store(Request $r)
    {
        $portfolio = Portfolio::create(
            array_merge(
                $this->validated($r),
                ['user_id' => Auth::id()]
            )
        );

        $this->saveChildren($portfolio, $r);

        return redirect()->to(
            route('portfolios.templates', ['portfolio' => $portfolio->id], false)
        )->with('ok', 'Saved to the online database! Now choose a template.');
    }

    // Show the form filled with the saved information
    // Show the form filled with the saved information
    public function edit(Request $request, Portfolio $portfolio)
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );

        $portfolio->load(self::RELATIONS);

        $template = in_array($request->query('template'), self::TEMPLATES, true)
            ? $request->query('template')
            : ($portfolio->template ?: 'simple');

        return view('portfolios.edit', compact('portfolio', 'template'));
    }

    // Save the changes, then go back to the template page
        public function update(Request $r, Portfolio $portfolio)
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );

        $portfolio->update($this->validated($r));

        $this->saveChildren($portfolio, $r);

        $template = in_array($r->input('template'), self::TEMPLATES, true)
            ? $r->input('template')
            : ($portfolio->template ?: 'simple');

        if ($r->input('return_to') === 'templates') {
            return redirect()->route('portfolios.templates', [
                'portfolio' => $portfolio->id,
            ])->with('ok', 'Portfolio updated!');
        }

        return redirect()->route('portfolios.show', [
            'portfolio' => $portfolio->id,
            'template' => $template,
        ])->with('ok', 'Portfolio updated!');
    }

    public function destroy(Portfolio $portfolio)
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );

        $portfolio->delete();

        return redirect()
            ->route('portfolios.index')
            ->with('ok', 'Portfolio deleted successfully.');
    }

    /* =========================================
       TEMPLATES
    ========================================= */

    // Template selection page: shows the 3 templates
    public function templates(Portfolio $portfolio)
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );

        return view('portfolios.templates', compact('portfolio'));
    }

    // Save the chosen template, then open the preview
    public function chooseTemplate(Request $r, Portfolio $portfolio)
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );

        $r->validate([
            'template' => 'required|in:' . implode(',', self::TEMPLATES),
        ]);

        $portfolio->update(['template' => $r->template]);

        return redirect()->to(
            route('portfolios.show', ['portfolio' => $portfolio->id], false)
        );
    }

    /* =========================================
       VIEW THE PORTFOLIO
    ========================================= */

    // Preview page (with the preview bar for editing / changing template)
    public function show(Request $r, Portfolio $portfolio)
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );

        $portfolio->load(self::RELATIONS);

        $tpl = in_array($r->query('template'), self::TEMPLATES)
            ? $r->query('template')
            : ($portfolio->template ?: 'simple');

        return view("templates.$tpl", compact('portfolio'));
    }

    // Public page: the finished portfolio without the preview bar
    public function publicShow(Portfolio $portfolio)
    {
        $portfolio->load(self::RELATIONS);

        // Use the saved template, or "simple" if it is missing or invalid
        $tpl = in_array($portfolio->template, self::TEMPLATES)
            ? $portfolio->template
            : 'simple';

        return view("templates.$tpl", [
            'portfolio' => $portfolio,
            'isPublic'  => true, // hides the preview bar in the template
        ]);
    }
     
    /* =========================================
       HELPERS (used only inside this class)
    ========================================= */

    // Check the personal information from the form and prepare it for saving
    private function validated(Request $r): array
    {
        // Validate the personal information
        $data = $r->validate([
            'full_name' => 'required|string|max:255',
            'title'     => 'nullable|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:50',
            'address'   => 'nullable|string|max:255',
            'website'   => 'nullable|string|max:255',
            'about'     => 'nullable|string|max:5000',
            'photo'     => 'nullable|image|max:1024', // up to 1 MB
        ]);

        // Convert the uploaded profile picture to Base64 so it is stored
        // in the database itself (no file storage needed)
        if ($r->hasFile('photo')) {
            $photo = $r->file('photo');

            $data['photo'] = 'data:' . $photo->getMimeType()
                . ';base64,'
                . base64_encode(file_get_contents($photo->getRealPath()));
        } else {
            // No new photo: keep the old one when editing
            unset($data['photo']);
        }

        // Remove an unwanted Markdown heading from the beginning of About Me
        if (isset($data['about'])) {
            $data['about'] = trim(
                preg_replace('/^\s*#{1,6}\s*(about\s*me)\s*/i', '', $data['about'])
            );
        }

        return $data;
    }

    // Replace the saved education, skills, projects, experience and links
    private function saveChildren(Portfolio $p, Request $r): void
    {
        foreach (self::RELATIONS as $rel) {
            // Keep only the rows where at least one field is filled in
            $rows = collect($r->input($rel, []))
                ->filter(fn ($row) => is_array($row)
                    && collect($row)->filter(
                        fn ($value) => $value !== null && $value !== ''
                    )->isNotEmpty())
                ->values()
                ->all();

            // Delete the old rows, then save the new ones
            $p->$rel()->delete();
            $p->$rel()->createMany($rows);
        }
    }
}