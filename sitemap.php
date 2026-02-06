<?php
header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';

// Update this with your actual domain
$domain = 'https://sheetai.app';
$date = date('Y-m-d');
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>
            <?php echo $domain; ?>/
        </loc>
        <lastmod>
            <?php echo $date; ?>
        </lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>
            <?php echo $domain; ?>/pricing
        </loc>
        <lastmod>
            <?php echo $date; ?>
        </lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>
            <?php echo $domain; ?>/privacy
        </loc>
        <lastmod>
            <?php echo $date; ?>
        </lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>
            <?php echo $domain; ?>/terms
        </loc>
        <lastmod>
            <?php echo $date; ?>
        </lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>
            <?php echo $domain; ?>/refund
        </loc>
        <lastmod>
            <?php echo $date; ?>
        </lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>
            <?php echo $domain; ?>/login
        </loc>
        <lastmod>
            <?php echo $date; ?>
        </lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
</urlset>