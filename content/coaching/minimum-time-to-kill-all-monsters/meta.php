<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Kill All Monsters: bitmask, ceiling division, masks in increasing order',
    'leetcode' => 2403,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep the whole defeated set rather than a greedy order, round each fight’s days up, and fill masks from small to large. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-time-to-kill-all-monsters',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'step-by-step'],
];
