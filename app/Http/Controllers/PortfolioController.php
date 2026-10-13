<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private const RELATIONS = ['educations', 'skills', 'projects', 'experiences', 'links'];
    private const TEMPLATES = ['simple', 'modern', 'creative'];

    public function index()
    {
        return view('portfolios.index', ['portfolios' => Portfolio::latest()->get()]);
    }

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $r)
{
    $portfolio = Portfolio::create($this->validated($r));
    $this->saveChildren($portfolio, $r);

  return redirect()->to(
    route('portfolios.templates', ['portfolio' => $portfolio->id], false)
    )->with('ok', 'Saved to the online database! Now choose a template.');

}

    public function edit(Portfolio $portfolio)
    {
        $portfolio->load(self::RELATIONS);
        return view('portfolios.edit', compact('portfolio'));
    }

   public function update(Request $r, Portfolio $portfolio)
{
    $portfolio->update($this->validated($r));

    $this->saveChildren($portfolio, $r);

   return redirect()->to(
    url('/portfolios/' . $portfolio->id . '/templates')
)->with('ok', 'Portfolio updated!');

}

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
       return redirect()->to(route('portfolios.index', [], false))
    ->with('ok', 'Portfolio deleted.');   
    }

    public function templates(Portfolio $portfolio)
    {
        return view('portfolios.templates', compact('portfolio'));
    }

    public function chooseTemplate(Request $r, Portfolio $portfolio)
    {
        $r->validate(['template' => 'required|in:' . implode(',', self::TEMPLATES)]);
        $portfolio->update(['template' => $r->template]);

        return redirect()->to(
    route('portfolios.show', ['portfolio' => $portfolio->id], false)
);
    }

    public function show(Request $r, Portfolio $portfolio)
    {
        $portfolio->load(self::RELATIONS);

        $tpl = in_array($r->query('template'), self::TEMPLATES)
        ? $r->query('template')
        : ($portfolio->template ?: 'simple');

        return view("templates.$tpl", compact('portfolio'));
    }

        public function publicShow(Portfolio $portfolio)
    {
        $portfolio->load(self::RELATIONS);

        $tpl = in_array($portfolio->template, self::TEMPLATES)
            ? $portfolio->template
            : 'simple';

        return view("templates.$tpl", [
            'portfolio' => $portfolio,
            'isPublic' => true,
        ]);
    }

    private function validated(Request $r): array
    {
        // Validate personal information
        $data = $r->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:50',
            'address'   => 'nullable|string|max:255',
            'about'     => 'nullable|string|max:5000',
            'photo'     => 'nullable|image|max:1024',
        ]);

        // Convert the uploaded profile picture to Base64
        if ($r->hasFile('photo')) {
            $photo = $r->file('photo');

            $data['photo'] = 'data:' . $photo->getMimeType()
            . ';base64,'
            . base64_encode(file_get_contents($photo->getRealPath()));
        } else {
        unset($data['photo']);
        }
        // Remove an unwanted Markdown heading from the beginning of About Me
        if (isset($data['about'])) {
            $data['about'] = trim(
                preg_replace(
                    '/^\s*#{1,6}\s*(about\s*me)\s*/i',
                    '',
                    $data['about']
                )
            );
        }
        return $data;
    }

    private function saveChildren(Portfolio $p, Request $r): void
    {
        foreach (self::RELATIONS as $rel) {
        $rows = collect($r->input($rel, []))
            ->filter(fn ($row) => is_array($row)
                && collect($row)->filter(
                    fn ($value) => $value !== null && $value !== ''
                )->isNotEmpty())
            ->values()
            ->all();

            $p->$rel()->delete();
            $p->$rel()->createMany($rows);
        }
    }
}