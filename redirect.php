<?php
/**
 * Redirect handler for /projects/{name}/ URLs to subdomains
 * This is a fallback if .htaccess is not available or not working
 */

// Get the project name from the URL
$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', trim($uri, '/'));

// Check if this is a /projects/{name}/ request
if (isset($parts[0]) && $parts[0] === 'projects' && isset($parts[1])) {
    $projectName = $parts[1];
    
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

