@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($staticRoute as $route)
        <url>
            <loc>{{$route['link']}}</loc>
            <lastmod>{{date('Y-m-d H:i:s')}}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach($dynamicRoute as $ClassName)
            @foreach($ClassName as $route)
        <url>
            <loc>{{$route['link']}}</loc>
            <lastmod>{{$route['lastmod']->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
            @endforeach
    @endforeach
</sitemapindex>