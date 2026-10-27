<?php
declare(strict_types=1);

return [
    'title' => 'Delivering Boxes: which boxes ride on the last trip?',
    'leetcode' => 1687,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = fewest trips for the first i boxes. The last trip carries boxes j to i−1 if they fit the box and weight limits: dp[j] + (port changes inside) + 2 (first stop and the return).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'delivering-boxes-from-storage-to-ports',
    'related_session' => 'delivering-boxes-from-storage-to-ports',
];
