<?php
declare(strict_types=1);

return [
    'title' => 'Number of Equivalent Domino Pairs: canonical keys',
    'leetcode' => 1128,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: key each domino by (smaller, larger), add the count of earlier dominoes with that key, then record it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'number-of-equivalent-domino-pairs',
    'tags' => ['hash-table', 'counting', 'arrays', 'step-by-step'],
];
