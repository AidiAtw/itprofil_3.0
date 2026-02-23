<?php
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

class ProfilePresenter
{
    private $profileData;

    public function __construct(array $profileData)
    {
        $this->profileData = $profileData;
    }

    public function getName()
    {
        return isset($this->profileData['name']) 
            ? htmlspecialchars($this->profileData['name']) 
            : 'Profil';
    }

    public function getBio()
    {
        return isset($this->profileData['bio']) 
            ? htmlspecialchars($this->profileData['bio']) 
            : '';
    }

    public function getSkills()
    {
        return isset($this->profileData['skills']) && is_array($this->profileData['skills']) 
            ? $this->profileData['skills'] 
            : [];
    }

    public function getProjects()
    {
        if (!isset($this->profileData['projects']) || !is_array($this->profileData['projects'])) {
            return [];
        }
        
        $projects = $this->profileData['projects'];
        foreach ($projects as &$project) {
            if (!isset($project['title'])) {
                $project['title'] = 'Neznámý projekt';
            }
            if (!isset($project['description'])) {
                $project['description'] = '';
            }
        }
        unset($project);
        
        return $projects;
    }

    public function getInterests()
    {
        return isset($this->profileData['interests']) && is_array($this->profileData['interests']) 
            ? $this->profileData['interests'] 
            : [];
    }
}

$loader = new ProfileLoader(__DIR__ . '/profile.json');
$profileData = $loader->load();
$presenter = new ProfilePresenter($profileData);


$name = isset($profileData['name']) ? htmlspecialchars($profileData['name']) : 'Profil';
$bio = isset($profileData['bio']) ? htmlspecialchars($profileData['bio']) : '';
$skills = isset($profileData['skills']) && is_array($profileData['skills']) ? $profileData['skills'] : [];
$projects = isset($profileData['projects']) && is_array($profileData['projects']) ? $profileData['projects'] : [];
$interests = isset($profileData['interests']) && is_array($profileData['interests']) ? $profileData['interests'] : [];

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
    <title><?php echo $presenter->getName(); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $presenter->getName(); ?></h1>
        
        <?php if (!empty($presenter->getBio())): ?>
            <p class="bio"><?php echo $presenter->getBio(); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($presenter->getSkills())): ?>
            <section class="skills-section">
                <h2>Dovednosti</h2>
                <ul class="skills-list">
                    <?php foreach ($presenter->getSkills() as $skill): ?>
                        <li><?php echo htmlspecialchars($skill); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>
        
        <?php if (!empty($presenter->getProjects())): ?>
            <section class="projects-section">
                <h2>Projekty</h2>
                <div class="projects-list">
                    <?php foreach ($presenter->getProjects() as $project): ?>
                        <div class="project-card">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
        
        <?php if (!empty($presenter->getInterests())): ?>
            <section class="interests-section">
                <h2>Zájmy</h2>
                <ul class="interests-list">
                    <?php foreach ($presenter->getInterests() as $interest): ?>
                        <li><?php echo htmlspecialchars($interest); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>
