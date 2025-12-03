<?php
/**
 * Redirect handler for /projects/{name}/ URLs to subdomains
 * Converts underscores to hyphens for subdomain format
 */

// Get the project name from query parameter (passed by .htaccess) or from URL
$projectName = null;

if (isset($_GET['project'])) {
    // Get from query parameter (when called via .htaccess rewrite)
    $projectName = $_GET['project'];
} else {
    // Fallback: parse from REQUEST_URI if accessed directly
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', trim($uri, '/'));
    
    if (isset($parts[0]) && $parts[0] === 'projects' && isset($parts[1])) {
        $projectName = $parts[1];
    }
}

if ($projectName) {
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

