<?php
declare(strict_types=1);

return [
    'title' => 'Count Non Adjacent Subsets in a Rooted Tree: tree DP over sums mod k',
    'leetcode' => 3939,
    'difficulty' => 'Hard',
    'summary' => 'For each node keep two count arrays by sum mod k: node skipped and node taken. Taken nodes combine with children that are skipped; skipped nodes combine with either.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'count-non-adjacent-subsets-in-a-rooted-tree',
];
