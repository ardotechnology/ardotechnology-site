<?php

class SeoHelper
{
    private static $definitions = null;
    private static $configFile = __DIR__ . '/../seo/definitions.json';

    /**
     * Load SEO data for a specific page key.
     *
     * @param string $pageKey The key identifying the page in definitions.json
     * @param array $variables Associative array of variables to replace (e.g., ['city' => 'Querétaro'])
     * @return array|null The processed SEO data or null if not found
     */
    public static function load($pageKey, $variables = [])
    {
        if (self::$definitions === null) {
            if (!file_exists(self::$configFile)) {
                error_log("SEO config file not found: " . self::$configFile);
                return null;
            }
            $json = file_get_contents(self::$configFile);
            self::$definitions = json_decode($json, true);
        }

        if (!isset(self::$definitions['pages'][$pageKey])) {
            return null;
        }

        $pageData = self::$definitions['pages'][$pageKey];

        // Merge global variables with passed variables
        $allVariables = array_merge(
            self::$definitions['globals'] ?? [],
            $variables
        );

        // Recursive substitution
        return self::substituteVariables($pageData, $allVariables);
    }

    /**
     * Recursively replace {{key}} placeholders in the data array.
     */
    private static function substituteVariables($data, $variables)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::substituteVariables($value, $variables);
            }
            return $data;
        } elseif (is_string($data)) {
            foreach ($variables as $varKey => $varValue) {
                $placeholder = '{{' . $varKey . '}}';
                if (strpos($data, $placeholder) !== false) {
                    $data = str_replace($placeholder, $varValue, $data);
                }
            }
            return $data;
        }
        return $data;
    }

    /**
     * Render the HTML tags for the SEO data.
     * 
     * @param array $seoData The processed SEO data array
     */
    public static function render($seoData)
    {
        if (!$seoData)
            return;

        // Title
        $title = $seoData['title'] ?? $seoData['meta']['title'] ?? '';
        if (!empty($title)) {
            echo '<title>' . htmlspecialchars($title) . '</title>' . "\n";
        }

        // Meta Description
        $description = $seoData['description'] ?? $seoData['meta']['description'] ?? '';
        if (!empty($description)) {
            echo '<meta name="description" content="' . htmlspecialchars($description) . '">' . "\n";
        }

        // Keywords
        $keywords = $seoData['keywords'] ?? $seoData['meta']['keywords'] ?? '';
        if (!empty($keywords)) {
            echo '<meta name="keywords" content="' . htmlspecialchars($keywords) . '">' . "\n";
        }

        // Canonical
        $canonical = $seoData['canonical'] ?? $seoData['meta']['canonical'] ?? '';
        if (!empty($canonical)) {
            echo '<link rel="canonical" href="' . htmlspecialchars($canonical) . '">' . "\n";
        }

        // OG Tags
        $og = $seoData['og'] ?? [];
        if (!empty($og) || !empty($seoData['og_image'])) {
            $ogTitle = $og['title'] ?? $title;
            $ogDescription = $og['description'] ?? $description;
            $ogImage = $og['image'] ?? $seoData['og_image'] ?? '';
            $ogUrl = $og['url'] ?? '';

            if (!empty($ogTitle))
                echo '<meta property="og:title" content="' . htmlspecialchars($ogTitle) . '">' . "\n";
            if (!empty($ogDescription))
                echo '<meta property="og:description" content="' . htmlspecialchars($ogDescription) . '">' . "\n";
            if (!empty($ogImage))
                echo '<meta property="og:image" content="' . htmlspecialchars($ogImage) . '">' . "\n";

            if (empty($ogUrl)) {
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
                $ogUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }
            echo '<meta property="og:url" content="' . htmlspecialchars($ogUrl) . '">' . "\n";
            echo '<meta property="og:locale" content="es_MX">' . "\n";
            echo '<meta property="og:type" content="website">' . "\n";
        }

        // Twitter Tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $twitterTitle = $seoData['twitter']['title'] ?? $og['title'] ?? $title;
        $twitterDesc = $seoData['twitter']['description'] ?? $og['description'] ?? $description;
        $twitterImage = $seoData['twitter']['image'] ?? $og['image'] ?? $seoData['og_image'] ?? '';

        if (!empty($twitterTitle)) {
            echo '<meta name="twitter:title" content="' . htmlspecialchars($twitterTitle) . '">' . "\n";
        }
        if (!empty($twitterDesc)) {
            echo '<meta name="twitter:description" content="' . htmlspecialchars($twitterDesc) . '">' . "\n";
        }
        if (!empty($twitterImage)) {
            echo '<meta name="twitter:image" content="' . htmlspecialchars($twitterImage) . '">' . "\n";
        }

        // JSON-LD
        $jsonLd = $seoData['json_ld'] ?? [];

        // Auto-generate Schema if city data is present and json_ld is empty
        if (!empty($seoData['city']) && empty($jsonLd)) {
            $city = $seoData['city'];
            $region = $seoData['region'] ?? '';
            $geo = $seoData['geo'] ?? ''; // Format "lat;long"
            $coords = explode(';', $geo);
            $lat = isset($coords[0]) ? trim($coords[0]) : '';
            $lng = isset($coords[1]) ? trim($coords[1]) : '';
            $canonical = $seoData['canonical'] ?? '';
            $description = $seoData['description'] ?? $seoData['meta']['description'] ?? '';

            $jsonLd = [
                [
                    "@context" => "https://schema.org",
                    "@type" => "LocalBusiness",
                    "name" => "ARDO Technology " . $city,
                    "image" => "https://ardo.technology/images/Logo.webp",
                    "@id" => $canonical,
                    "url" => $canonical,
                    "telephone" => "+524429803200",
                    "address" => [
                        "@type" => "PostalAddress",
                        "streetAddress" => "Cobertura en " . $city,
                        "addressLocality" => $city,
                        "addressRegion" => $region,
                        "postalCode" => "76100",
                        "addressCountry" => "MX"
                    ],
                    "geo" => [
                        "@type" => "GeoCoordinates",
                        "latitude" => (float) $lat,
                        "longitude" => (float) $lng
                    ],
                    "areaServed" => $city . ", " . $region
                ],
                [
                    "@context" => "https://schema.org/",
                    "@type" => "Product",
                    "name" => "PBX Cloud ARDO",
                    "image" => "https://ardo.technology/images/Logo.webp",
                    "description" => $description,
                    "brand" => [
                        "@type" => "Brand",
                        "name" => "ARDO Technology"
                    ],
                    "offers" => [
                        "@type" => "Offer",
                        "url" => $canonical,
                        "priceCurrency" => "MXN",
                        "price" => "0",
                        "priceValidUntil" => "2025-12-31",
                        "availability" => "https://schema.org/InStock",
                        "itemCondition" => "https://schema.org/NewCondition"
                    ]
                ]
            ];
        }

        if (!empty($jsonLd)) {
            echo '<script type="application/ld+json">' . "\n";
            echo json_encode($jsonLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            echo "\n</script>\n";
        }
    }
}
?>