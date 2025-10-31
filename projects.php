<?php
// Load projects from repositories.json
$repoFile = '/var/www/html/codelabhaven/repositories.json';
$projects = [];
$projectCount = 0;

if (file_exists($repoFile)) {
    $json = file_get_contents($repoFile);
    $data = json_decode($json, true);
    
    if (isset($data['repositories']) && is_array($data['repositories'])) {
        foreach ($data['repositories'] as $repo) {
            // Skip the main codelabhaven site, only show projects
            if ($repo['name'] !== 'codelabhaven') {
                $projects[] = [
                    'title' => ucfirst(str_replace('_', ' ', $repo['name'])),
                    'link' => '/projects/' . $repo['name'] . '/'
                ];
            }
        }
        $projectCount = count($projects);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - CodeLabHaven</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="/favicon.ico"> <!-- Favicon added -->
</head>
<body>
    <header class="header">
        <a href="/" class="header-title">
            <img src="/images/logo.svg" alt="CodeLabHaven Logo" class="header-logo"> <!-- SVG logo -->
        </a>
        <nav>
            <a href="/projects.php" class="active">projects<sup><?php echo $projectCount; ?></sup></a>
            <a href="/about.php">about</a>
        </nav>
    </header>
    <main class="main">
        <div class="cursor-wrapper">
            <div class="cursor" id="cursor"></div>
        </div>
        <section class="projects-page">
            <h1 class="main-title">projects</h1>
            <div class="projects-list">
                <?php foreach ($projects as $project): ?>
                    <div class="project-title-link">
                        <a href="<?php echo htmlspecialchars($project['link']); ?>" target="_blank"><?php echo strtolower($project['title']); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer-text">
            ©2025 codelabhaven<span class="dot">.</span> design by <a href="https://x.com/TheBlecky398" target="_blank">blecky398</a>
        </div>
        <div class="footer-right">
            powered by grok3
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>