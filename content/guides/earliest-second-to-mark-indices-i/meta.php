<?php
declare(strict_types=1);

return [
    'title' => 'Earliest Second to Mark Indices I: binary search with last occurrences',
    'leetcode' => 3048,
    'difficulty' => 'Med',
    'summary' => 'If all indices can be marked by second t, they can by any later second, so binary-search t. For a fixed t, mark each index at its last occurrence within the first t seconds and use every other second to decrement; scanning forward, the free seconds so far must cover nums[i] at each such mark.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'leetcode'],
    'related_session' => 'earliest-second-to-mark-indices-i',
];
