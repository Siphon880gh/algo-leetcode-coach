<?php
declare(strict_types=1);

return [
    'title' => 'Reverse Pairs: count across halves inside merge sort',
    'leetcode' => 493,
    'difficulty' => 'Hard',
    'summary' => 'Count pairs i < j with nums[i] > 2 × nums[j]. Merge sort: after sorting both halves, walk them with two pointers to count, for each right value, how many left values exceed twice it; then merge. Or a Fenwick tree over compressed values. Use 64-bit for 2 × nums[j]. [1,3,2,3,1] → 2. [2,4,3,5,1] → 3. Not 315.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'kind' => 'algo',
    'tags' => ['divide-and-conquer', 'merge-sort', 'binary-indexed-tree', 'leetcode'],
    'related_session' => 'reverse-pairs',
];
