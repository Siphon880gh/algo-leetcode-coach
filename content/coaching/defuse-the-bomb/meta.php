<?php
declare(strict_types=1);

return [
    'title' => 'Defuse the Bomb: circular sums',
    'leetcode' => 1652,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: k = 0 → zeros; k > 0 → sum of the next k; k < 0 → sum of the previous |k|; indices wrap mod n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'defuse-the-bomb',
    'tags' => ['sliding-window', 'array', 'step-by-step'],
];
