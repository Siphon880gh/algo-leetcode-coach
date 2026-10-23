<?php
declare(strict_types=1);

return [
    'title' => 'Largest 1-Bordered Square: runs of 1s to the left and up',
    'leetcode' => 1139,
    'difficulty' => 'Med',
    'summary' => 'left[r][c] / up[r][c] = consecutive 1s ending at (r,c). For bottom-right corner (r,c) and size s: need left and up at the corner ≥ s, up at the bottom-left corner ≥ s and left at the top-right corner ≥ s.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'largest-1-bordered-square',
    'related_session' => 'largest-1-bordered-square',
];
