<?php
declare(strict_types=1);

return [
    'title' => 'Max Strictly Increasing Cells: process values in order, best per row and column',
    'leetcode' => 2713,
    'difficulty' => 'Hard',
    'summary' => 'Sort cells by value. A cell\'s best path = 1 + max(bestRow[r], bestCol[c]) from strictly smaller values. Update rows or columns only after the whole group of equal values is computed.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-strictly-increasing-cells-in-a-matrix',
    'related_session' => 'maximum-strictly-increasing-cells-in-a-matrix',
];
