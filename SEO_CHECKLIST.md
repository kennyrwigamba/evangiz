# Evangiz SEO Checklist

## What Changed

- Added stronger unique SEO metadata for Home, Menu, About, Services, Outside Catering, Contact, Blog, and Blog Post routes.
- Added Google Analytics globally in `src/includes/header.php`.
- Improved Open Graph and Twitter/X metadata sitewide.
- Expanded JSON-LD structured data in `src/includes/structured-data.php` for Organization, Restaurant, LocalBusiness, WebSite, WebPage, BreadcrumbList, Menu, Service, and BlogPosting where applicable.
- Improved dynamic sitemap output at `https://evangiz.com/sitemap.xml`.
- Updated `robots.txt` to allow public crawling while keeping admin and internal source folders out of the index.
- Moved public project folders into `src/` while preserving clean public page URLs.

## Google Analytics

Google Analytics tag installed sitewide:

- Measurement ID: `G-19ZYWVPNZB`
- Installed in: `src/includes/header.php`

## Production URLs

- Production domain: `https://evangiz.com`
- Sitemap: `https://evangiz.com/sitemap.xml`
- Robots: `https://evangiz.com/robots.txt`

## Google Search Console Steps

1. Open Google Search Console.
2. Add a Domain property for `evangiz.com`, or a URL-prefix property for `https://evangiz.com/`.
3. Verify ownership with DNS TXT verification if possible.
4. Open **Sitemaps**.
5. Submit: `https://evangiz.com/sitemap.xml`.
6. Use **URL Inspection** for these URLs and click **Request indexing**:
   - `https://evangiz.com/`
   - `https://evangiz.com/menu`
   - `https://evangiz.com/catering`
   - `https://evangiz.com/services`
   - `https://evangiz.com/about`
   - `https://evangiz.com/contact`
7. Check **Pages** after a few days for crawl/indexing status.

## If Google Still Does Not Index

- Confirm the production server returns `200 OK` for `/`, `/sitemap.xml`, and `/robots.txt`.
- Confirm canonical tags point to `https://evangiz.com` and not localhost or a staging URL.
- Confirm no public pages have `noindex`.
- Confirm Search Console does not show DNS, SSL, redirect, or server errors.
- Confirm `robots.txt` does not block public pages or `/src/css`, `/src/js`, `/src/image`, and `/src/video`.
- Inspect the rendered HTML in Search Console to confirm Google can load CSS, JavaScript, and images.
- Build more trusted external links to the domain, including Google Business Profile, social profiles, partner sites, and directories.
