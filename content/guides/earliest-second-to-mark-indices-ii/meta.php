<?php
declare(strict_types=1);

return [
    'title' => 'Earliest Second to Mark Indices II: binary search, backward greedy with a heap',
    'leetcode' => 3049,
    'difficulty' => 'Hard',
    'summary' => 'Binary-search t. Within the first t seconds, setting an index to 0 is only worth doing at its first occurrence, and it needs a later free second to mark it. Scan backwards, tentatively zeroing; if no later second is free, drop the zeroing that saves the least (a min-heap). Then check the remaining seconds cover the other decrements and marks.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'binary-search', 'heap', 'leetcode'],
    'related_session' => 'earliest-second-to-mark-indices-ii',
];
