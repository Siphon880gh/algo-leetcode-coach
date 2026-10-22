<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Maximum Difference of Pairs: binary search, greedy neighbours',
    'leetcode' => 2616,
    'difficulty' => 'Med',
    'summary' => 'Sort, then binary search the answer d. For a given d, scan left to right and pair adjacent values whenever their gap is at most d, skipping both; d works if that makes at least p pairs.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'dynamic-programming', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'minimize-the-maximum-difference-of-pairs',
];
