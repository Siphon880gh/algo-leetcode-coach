<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Build Sturdy Brick Wall: row masks and DP',
    'leetcode' => 2184,
    'difficulty' => 'Med',
    'summary' => 'List every way to fill one row as a bitmask of its inner joint positions. Two rows can be stacked when their masks share no bit. DP over rows: ways(mask) at row r sums ways of compatible masks at row r − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'leetcode'],
    'related_session' => 'number-of-ways-to-build-sturdy-brick-wall',
];
