<?php
declare(strict_types=1);

return [
    'title' => 'Scramble String: try every split, kept or swapped',
    'leetcode' => 87,
    'difficulty' => 'Hard',
    'summary' => 'Same letters are required. Then for each split point k, either the two halves stay in order (s1[0..k) ~ s2[0..k)) or they were swapped (s1[0..k) ~ the last k letters of s2). Recurse with memo.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'scramble-string',
    'related_session' => 'scramble-string',
];
