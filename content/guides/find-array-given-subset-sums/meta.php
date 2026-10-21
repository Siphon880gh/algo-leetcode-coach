<?php
declare(strict_types=1);

return [
    'title' => 'Find Array Given Subset Sums: peel one element at a time',
    'leetcode' => 1982,
    'difficulty' => 'Hard',
    'summary' => 'Sort sums; d = s[1] − s[0] is the absolute value of some element. Pair each sum with sum + d (smallest first, using a counter) into groups A and A + d. If A contains 0, the element is d and continue with A; otherwise it is −d and continue with A + d.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'kind' => 'algo',
    'tags' => ['divide-and-conquer', 'array', 'sorting', 'leetcode'],
    'related_session' => 'find-array-given-subset-sums',
];
