<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Wear Different Hats: DP over hats, mask over people',
    'leetcode' => 1434,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: mask the ≤ 10 people, iterate the 40 hats; each hat is skipped or given to one person who likes it and has none. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-to-wear-different-hats-to-each-other',
    'tags' => ['dp', 'bitmask', 'step-by-step'],
];
