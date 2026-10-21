<?php
declare(strict_types=1);

return [
    'title' => 'Array Nesting: longest cycle of a permutation',
    'leetcode' => 565,
    'difficulty' => 'Med',
    'summary' => 'nums is a permutation of 0..n − 1. Following i → nums[i] splits the indexes into disjoint cycles, and the set s[k] is the cycle containing k. Walk each unvisited start, mark the cycle, and return the longest length. Visited marks make it O(n). [5,4,0,3,1,6,2] → 4.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['arrays', 'dfs', 'leetcode'],
    'related_session' => 'array-nesting',
];
