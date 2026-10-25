<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Devotional;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DevotionalController extends Controller
{
    public function index()
    {
        $devotionals = Devotional::withCount('completions')->orderByDesc('publish_date')->paginate(20);

        return view('dashboard.devotionals.index', compact('devotionals'));
    }

    public function create()
    {
        return view('dashboard.devotionals.form', ['devotional' => new Devotional(['published' => true])]);
    }

    public function store(Request $request)
    {
        Devotional::create($this->validated($request));

        return redirect(route('dashboard.devotionals.index'))->with('success', 'Devotional created.');
    }

    public function edit(Devotional $devotional)
    {
        return view('dashboard.devotionals.form', compact('devotional'));
    }

    public function update(Request $request, Devotional $devotional)
    {
        $devotional->update($this->validated($request, $devotional));

        return redirect(route('dashboard.devotionals.index'))->with('success', 'Devotional updated.');
    }

    public function destroy(Devotional $devotional)
    {
        // Completions are kept for members' history, so only unused devotionals can be deleted.
        if ($devotional->completions()->exists()) {
            return back()->with('error', 'This devotional has completions. Unpublish it instead of deleting.');
        }
        $devotional->delete();

        return redirect(route('dashboard.devotionals.index'))->with('success', 'Devotional deleted.');
    }

    public function togglePublish(Devotional $devotional)
    {
        $devotional->update(['published' => !$devotional->published]);

        return back()->with('success', 'Devotional status updated.');
    }

    private function validated(Request $request, ?Devotional $current = null): array
    {
        $data = $request->validate([
            'publish_date' => ['required', 'date_format:Y-m-d', Rule::unique('devotionals', 'publish_date')->ignore($current?->id)],
            'title' => ['required', 'string', 'max:255'],
            'scripture_reference' => ['required', 'string', 'max:255'],
            'scripture_text' => ['nullable', 'string'],
            'reflection' => ['required', 'string'],
            'prayer' => ['nullable', 'string'],
            'question' => ['nullable', 'string', 'max:255'],
            'author' => ['nullable', 'string', 'max:255'],
        ]);
        $data['published'] = $request->boolean('published');

        return $data;
    }
}
