<?php
// Hlavní aplikace pro zobrazení profilu

class ProfileLoader
{
    private $configFile;

    public function __construct($configPath)
    {
        $this->configFile = $configPath;
    }

    public function load()
    {
        if (!file_exists($this->configFile)) {
            return [];
        }
        
        $content = file_get_contents($this->configFile);
        return json_decode($content, true) ?? [];
    }
}

$loader = new ProfileLoader(__DIR__ . '/profile.json');
$profileData = $loader->load();

// Bezpečné získání dat s výchozími hodnotami
$name = isset($profileData['name']) ? htmlspecialchars($profileData['name']) : 'Profil';
$bio = isset($profileData['bio']) ? htmlspecialchars($profileData['bio']) : '';
$skills = isset($profileData['skills']) && is_array($profileData['skills']) ? $profileData['skills'] : [];
$projects = isset($profileData['projects']) && is_array($profileData['projects']) ? $profileData['projects'] : [];
$interests = isset($profileData['interests']) && is_array($profileData['interests']) ? $profileData['interests'] : [];

// Bezpečné zpracování dat projektů
foreach ($projects as &$project) {
    if (!isset($project['title'])) {
        $project['title'] = 'Neznámý projekt';
    }
    if (!isset($project['description'])) {
        $project['description'] = '';
    }
}
unset($project);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $name; ?></h1>
        
        <?php if (!empty($bio)): ?>
            <p class="bio"><?php echo $bio; ?></p>
        <?php endif; ?>
        
        <?php if (!empty($skills)): ?>
            <section class="skills-section">
                <h2>Dovednosti</h2>
                <ul class="skills-list">
                    <?php foreach ($skills as $skill): ?>
                        <li><?php echo htmlspecialchars($skill); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>
        
        <?php if (!empty($projects)): ?>
            <section class="projects-section">
                <h2>Projekty</h2>
                <div class="projects-list">
                    <?php foreach ($projects as $project): ?>
                        <div class="project-card">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
        
        <?php if (!empty($interests)): ?>
            <section class="interests-section">
                <h2>Zájmy</h2>
                <ul class="interests-list">
                    <?php foreach ($interests as $interest): ?>
                        <li><?php echo htmlspecialchars($interest); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>
