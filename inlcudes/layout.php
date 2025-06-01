<?php
// Determine the language code (e.g., "en" for "us", "fr" for "fr", etc.)
$isoToLang = [
    'us' => 'en',
    'ca' => 'en', // or 'fr-CA' if French-Canadian
    'fr' => 'fr',
    'de' => 'de',
    'jp' => 'ja',
    // Add more mappings as needed
];

// Detect ISO code from the directory name
$countryCode = basename(dirname(__FILE__)); // gets 'us' if in /lp/us

$langCode = $isoToLang[$countryCode] ?? 'en'; // fallback to English
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langCode ?? 'en') ?>">
    <?php include __DIR__ . '/head.php'; ?>
    <?php include __DIR__ . '/body.php'; ?>
</html>
