<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Achieve at Least K Peaks',
    'leetcode' => 3892,
    'difficulty' => 'Hard',
    'summary' => 'Peaks can never be adjacent on the circle, so more than ⌊n/2⌋ is impossible. Each index has a cost to become a peak. Choose k non-adjacent indices with minimum total cost: run a DP twice (index 0 unused, or index 0 used and n−1 unused).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-achieve-at-least-k-peaks',
    'related_session' => 'minimum-operations-to-achieve-at-least-k-peaks',
];
