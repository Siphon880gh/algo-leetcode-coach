<?php
declare(strict_types=1);

return [
    'title' => 'Twisted Mirror Path Count',
    'leetcode' => 3665,
    'difficulty' => 'Med',
    'summary' => 'Count paths with DP from the goal backwards. From a cell, a right move into a mirror slides down (and keeps bouncing through mirrors), a down move into a mirror slides right. Each landing cell is further down-right, so ways(cell) = ways(right landing) + ways(down landing).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'twisted-mirror-path-count',
    'related_session' => 'twisted-mirror-path-count',
];
