{{-- Shared frame for legal pages: plain, readable prose. Expects $heading and $updated. --}}
@include('partials.page-hero', [
    'title' => $heading,
    'eyebrow' => 'PCG App',
    'subtitle' => 'PCG app · Peyer Memorial Congregation' . (! empty($updated) ? ' · Last updated ' . $updated : ''),
    'image' => 'images/bantama/church_aerial.jpg',
    'crumbs' => [[$heading]],
])
<style>
    .legal h2 { font-size: 1.35rem; font-weight: 700; color: #0F172A; margin: 2rem 0 .6rem; }
    .legal p, .legal li { color: #475569; line-height: 1.7; }
    .legal ul { list-style: disc; padding-left: 1.4rem; margin: .5rem 0; }
    .legal a { color: #172554; text-decoration: underline; }
</style>
