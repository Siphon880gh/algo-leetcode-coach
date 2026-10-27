<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Area of Two Non-Overlapping Square Submatrices',
    'leetcode' => 4016,
    'difficulty' => 'Med',
    'summary' => 'If two disjoint k×k squares fit, two disjoint (k−1)×(k−1) squares fit inside them, so binary search k. For a candidate k, mark every top-left corner whose k×k block is all 1s (largest-square DP), and check whether two corners are far enough apart: rows or columns differ by at least k.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-area-of-two-non-overlapping-square-submatrices',
    'related_session' => 'maximum-area-of-two-non-overlapping-square-submatrices',
];
