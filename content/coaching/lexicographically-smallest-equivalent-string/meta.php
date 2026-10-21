<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest Equivalent String: smallest letter as root',
    'leetcode' => 1061,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: union the letters of each pair, always making the smaller letter the root, then map every letter of baseStr to its root. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'lexicographically-smallest-equivalent-string',
    'tags' => ['union-find', 'strings', 'step-by-step'],
];
