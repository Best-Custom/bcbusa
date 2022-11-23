<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($sitemap_detail as $content)
        <url>
            <loc>{{ $content->loc }}</loc>
            <lastmod>{{ Carbon\Carbon::now('Asia/Karachi') }}</lastmod>
            <changefreq>{{ $content->changefreq }}</changefreq>
            <priority>{{ $content->priority }}</priority>
        </url>
    @endforeach
</urlset> 