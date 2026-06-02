{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Static Routes -->
    <url>
        <loc>{{ route('frontend.home') }}</loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>{{ route('frontend.about') }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('frontend.services') }}</loc>
        <priority>0.8</priority>
        <changefreq>monthly</changefreq>
    </url>
    <url>
        <loc>{{ route('frontend.projects') }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('frontend.products') }}</loc>
        <priority>0.8</priority>
        <changefreq>weekly</changefreq>
    </url>
    <url>
        <loc>{{ route('frontend.blog') }}</loc>
        <priority>0.7</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>{{ route('frontend.contact') }}</loc>
        <priority>0.7</priority>
        <changefreq>monthly</changefreq>
    </url>

    <!-- Services Dynamic Routes -->
    @foreach($services as $service)
        <url>
            <loc>{{ route('frontend.services') }}#{{ $service->slug }}</loc>
            <priority>0.6</priority>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach

    <!-- Blogs Dynamic Routes -->
    @foreach($blogs as $blog)
        <url>
            <loc>{{ route('frontend.blog.single', $blog->slug) }}</loc>
            <priority>0.6</priority>
            <lastmod>{{ $blog->updated_at ? $blog->updated_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach
</urlset>
