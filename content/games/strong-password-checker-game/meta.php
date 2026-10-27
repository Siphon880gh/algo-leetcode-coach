<?php
declare(strict_types=1);

return [
    'title' => 'Strong Password Checker',
    'leetcode' => 420,
    'difficulty' => 'Hard',
    'summary' => 'Count missing types (lower or upper divided by digit) and runs of at least 3. Short: max(6 − n, missing). Medium: max(missing, the sum of (run divided by 3, rounded down)). Long: spend n − 20 deletions first on runs with len % 3 == 0, then % 3 == 1 (2 each), then 3 per replacement; answer = deletions + max(missing, replacements left).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'strong-password-checker',
    'related_session' => 'strong-password-checker',
];
