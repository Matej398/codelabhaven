<?php
/**
 * Redirect handler for /projects/{name}/ URLs to subdomains
 * Converts underscores to hyphens for subdomain format
 */

// Get the project name from query parameter (passed by .htaccess) or from URL
$projectName = null;

if (isset($_GET['project']) && !empty($_GET['project'])) {
    // Get from query parameter (when called via .htaccess rewrite)
    $projectName = trim($_GET['project']);
} else {
    // Fallback: parse from REQUEST_URI if accessed directly
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $parts = explode('/', trim($uri, '/'));
    
    if (isset($parts[0]) && $parts[0] === 'projects' && isset($parts[1]) && !empty($parts[1])) {
        $projectName = trim($parts[1]);
    }
}

if ($projectName) {
    // Clean the project name (remove any query strings or fragments that might have been included)
    $projectName = preg_replace('/[^a-zA-Z0-9_-]/', '', $projectName);
    
    // Special handling for crypto_folio - redirect to its own domain
    if ($projectName === 'crypto_folio') {
        header('Location: https://poorty.com', true, 301);
        exit;
    }
    
    // Convert underscores to hyphens for subdomain format
    $subdomainName = str_replace('_', '-', $projectName);
    
    // Redirect to subdomain format
    $subdomain = 'https://' . $subdomainName . '.codelabhaven.com';
    header('Location: ' . $subdomain, true, 301);
    exit;
}

// If not a project redirect, return 404
http_response_code(404);
echo 'Project not found';

