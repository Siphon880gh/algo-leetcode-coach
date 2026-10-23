<?php
declare(strict_types=1);

return [
    'title' => 'Longest Increasing Path: largest values first',
    'leetcode' => 329,
    'difficulty' => 'Hard',
    'summary' => 'Process cells from the largest value down. len[cell] = 1 + the best len among strictly larger neighbors (already final). The answer is the max len.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-increasing-path-in-a-matrix',
    'related_session' => 'longest-increasing-path-in-a-matrix',
];
