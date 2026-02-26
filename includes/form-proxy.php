<?php
// Target URL
$url = 'https://aoi.ardo.technology/forms/wtl/529291185b079044bc1baa69571d4370';

// Fetch content
$content = file_get_contents($url);

if ($content === false) {
    die("Error loading form.");
}

// Base URL for relative links
$baseUrl = 'https://aoi.ardo.technology/forms/wtl/';

// HTML Injection: Title and Subtext
$customHeader = <<<EOT
<div class="custom-form-header">
    <h2 class="form-title">Enviar Consulta</h2>
    <p class="form-subtitle">Complete el formulario y un ingeniero se pondrá en contacto pronto.</p>
</div>
EOT;

// Inject Header inside the form, specifically before the first internal row
$formPos = strpos($content, '<form');
if ($formPos !== false) {
    // Find the first 'row' AFTER the form tag
    $rowPos = strpos($content, '<div class="row', $formPos);
    if ($rowPos !== false) {
        $content = substr_replace($content, $customHeader, $rowPos, 0);
    }
}

// CSS Injection
$styles = <<<EOT
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
<style>
    .custom-form-wrapper {
        font-family: 'Inter', sans-serif !important;
        background-color: transparent !important;
        padding: 0 !important;
        width: 100% !important;
    }

    /* Target the form container specifically */
    .custom-form-wrapper form {
        background: #ffffff !important;
        padding: 40px !important;
        border-radius: 2rem !important;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05) !important;
        border: 1px solid #E2E8F0 !important;
    }

    @media (max-width: 768px) {
        .custom-form-wrapper form {
            padding: 32px 24px !important;
            border-radius: 1.5rem !important;
        }
    }

    /* Header Styles */
    .custom-form-header {
        text-align: left !important;
        margin-bottom: 32px !important;
    }
    .form-title {
        font-family: 'Inter', sans-serif !important;
        font-weight: 900 !important;
        font-size: 1.75rem !important;
        color: #050505 !important;
        margin: 0 0 8px 0 !important;
        line-height: 1.1 !important;
        letter-spacing: -0.02em !important;
        text-transform: uppercase !important;
    }
    .form-subtitle {
        font-family: 'Inter', sans-serif !important;
        font-size: 14px !important;
        color: rgba(10, 25, 47, 0.6) !important;
        margin: 0 !important;
    }

    @media (max-width: 480px) {
        .custom-form-header { text-align: center !important; }
        .form-title { font-size: 1.5rem !important; }
    }

    /* Form Fields Layout */
    .custom-form-wrapper .row {
        margin: 0 !important;
        display: block !important;
    }

    .custom-form-wrapper .col-md-6, 
    .custom-form-wrapper .col-md-12 {
        width: 100% !important;
        float: none !important;
        padding: 0 !important;
        margin-bottom: 24px !important;
    }
    
    /* Labels */
    .custom-form-wrapper label.control-label {
        font-family: 'Inter', sans-serif !important;
        font-weight: 700 !important;
        font-size: 13px !important;
        color: #050505 !important;
        margin-bottom: 10px !important;
        display: block !important;
        text-align: left !important;
        text-transform: none !important;
    }

    .custom-form-wrapper label.control-label .text-danger {
        color: #00F0FF !important; /* Ardo Primary for required dot */
    }
    
    /* Inputs */
    .custom-form-wrapper .form-control {
        background-color: #F8FAFB !important;
        border: 1px solid #E2E8F0 !important;
        border-radius: 12px !important;
        padding: 14px 18px !important;
        height: auto !important;
        box-shadow: none !important;
        font-family: 'Inter', sans-serif !important;
        font-size: 15px !important;
        color: #050505 !important;
        width: 100% !important;
        transition: all 0.2s ease !important;
    }
    
    .custom-form-wrapper .form-control:focus {
        background-color: #ffffff !important;
        border-color: #00F0FF !important;
        box-shadow: 0 0 0 4px rgba(0, 240, 255, 0.1) !important;
        outline: none !important;
    }
    
    .custom-form-wrapper textarea.form-control {
        min-height: 140px !important;
    }
    
    /* Button Wrapper */
    .custom-form-wrapper .submit-btn-wrapper {
        text-align: left !important;
        padding-top: 12px !important;
        margin: 0 !important;
    }
    
    .custom-form-wrapper button.btn {
        background-color: #050505 !important;
        color: #ffffff !important;
        font-family: 'JetBrains Mono', monospace !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 18px 32px !important;
        width: 100% !important;
        border-radius: 10px !important;
        border: none !important;
        text-transform: uppercase !important;
        letter-spacing: 0.2em !important;
        cursor: pointer !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    
    .custom-form-wrapper button.btn:hover {
        background-color: #0A192F !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Checkbox & Recaptcha */
    .custom-form-wrapper .checkbox {
        margin-top: 10px !important;
        margin-bottom: 25px !important;
    }

    .custom-form-wrapper .g-recaptcha {
        margin-bottom: 24px !important;
        transform: scale(0.9);
        transform-origin: 0 0;
    }

    @media (max-width: 430px) {
        .custom-form-wrapper .g-recaptcha {
            transform: scale(0.85);
        }
    }
</style>
EOT;

// CLEANUP FOR EMBEDDING
// 0. Aggressively strip external styles and scripts to prevent conflict
// Remove all <link> tags (CSS)
$content = preg_replace('/<link[^>]*>/i', '', $content);
// Remove all <script> tags (JS) - Note: this disables client-side validation, but it's necessary if it breaks the site.
// Alternatively, if validation matches standard jQuery/Bootstrap versions already on site, it might be okay,
// but usually external CSS is the culprit for layout breakage.
// Let's strip scripts too to be safe, or at least the ones that load libraries.
// 0. DO NOT STRIP SCRIPTS - REQUIRED FOR CAPTCHA AND VALIDATION
// $content = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $content);
// $content = preg_replace('/<script[^>]*>/i', '', $content); // Self-closing or src scripts

// 1. Remove DOCTYPE, html, head, body tags
$content = preg_replace('/<!DOCTYPE[^>]*>/i', '', $content);
$content = preg_replace('/<html[^>]*>/i', '', $content);
$content = preg_replace('/<\/html>/i', '', $content);
$content = preg_replace('/<head[^>]*>/i', '', $content);
$content = preg_replace('/<\/head>/i', '', $content);
$content = preg_replace('/<body[^>]*>/i', '<div class="custom-form-wrapper">', $content); // Change body to div wrapper
$content = preg_replace('/<\/body>/i', '</div>', $content);

// 2. Inject styles (appended to content or prepended)
// Since we removed head, we just prepend styles/scripts to the content
$content = $styles . $content;

// 3. Fix Relative URLs
// Since we are embedding, we cannot use <base>. We must rewrite links.
// Rewrite src="..."
$content = preg_replace('/src="([^http|\/][^"]*)"/', 'src="' . $baseUrl . '$1"', $content);
// Rewrite href="..." for CSS/Links
$content = preg_replace('/href="([^http|\/][^"]*)"/', 'href="' . $baseUrl . '$1"', $content);
// Rewrite action="..."
$content = preg_replace('/action="([^http|\/][^"]*)"/', 'action="' . $baseUrl . '$1"', $content);

// 4. Custom Success Message & Redirect behavior
// Replace the JS success message with our custom Spanish message
$customSuccess = "¡Tu mensaje ha sido enviado con éxito!";
$content = preg_replace(
    "/\\$\\('#response'\\)\\.html\\('<div class=\"alert alert-success\">' \\+\\s*response\\.message \\+ '<\/div>'\\);/s", /* Match multiline */
    "$('#response').html('<div class=\"alert alert-success\">" . $customSuccess . "</div>');",
    $content
);

// Modify redirect to open in new tab instead of current window.top.location
// The original code uses:
/*
if (form_redirect_url !== '0') {
    if (window.top) {
        window.top.location.href = form_redirect_url;
    } else {
        window.location.href = form_redirect_url;
    }
    return;
}
*/
$content = preg_replace(
    '/if\s*\(form_redirect_url\s*!==\s*\'0\'\)\s*\{\s*if\s*\(window\.top\)\s*\{\s*window\.top\.location\.href\s*=\s*form_redirect_url;\s*\}\s*else\s*\{\s*window\.location\.href\s*=\s*form_redirect_url;\s*\}\s*return;\s*\}/s',
    'if (form_redirect_url !== \'0\') { window.open(form_redirect_url, \'_blank\'); }',
    $content
);

echo $content;
?>