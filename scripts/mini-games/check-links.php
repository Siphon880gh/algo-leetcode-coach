<?php
// Check that every game resolves from its Algo Guide (and coaching session, when one exists)
// through the same lookup the site uses: includes/content.php companion_existing_slug(),
// which matches on related_* keys, then the slug, then the LeetCode number.
// usage: php scripts/mini-games/check-links.php      (no server needed; takes a few minutes)
declare(strict_types=1);

chdir(dirname(__DIR__, 2));
require 'includes/content.php';
$bad = 0; $ok = 0; $sess = 0; $sessOk = 0;
foreach (glob('content/games/*-game/meta.php') as $f) {
    $slug = basename(dirname($f));
    $m = require $f;
    $g = $m['related_guide'] ?? '';
    $guide = load_content('guides', $g);
    if (!$guide) { echo "NOGUIDE $slug -> " . var_export($g, true) . "\n"; $bad++; continue; }
    $got = companion_existing_slug('games', $guide['meta'] ?? $guide, $g, 'related_game');
    if ($got === $slug) $ok++; else { echo "MISMATCH guide $g -> " . var_export($got, true) . " (expected $slug)\n"; $bad++; }
    $s = load_content('coaching', $g);
    if ($s) {
        $sess++;
        $gs = companion_existing_slug('games', $s['meta'] ?? $s, $g, 'related_game');
        if ($gs === $slug) $sessOk++; else { echo "MISMATCH session $g -> " . var_export($gs, true) . "\n"; $bad++; }
    }
}
echo "guides ok $ok; sessions $sess linked $sessOk; bad $bad\n";
exit($bad ? 1 : 0);
