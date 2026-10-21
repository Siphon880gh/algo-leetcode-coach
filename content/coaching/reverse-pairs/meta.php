<?php
declare(strict_types=1);

return [
    'title' => 'Reverse Pairs: count across halves inside merge sort',
    'leetcode' => 493,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count i < j with nums[i] > 2 × nums[j]. Merge sort: with both halves sorted, a pointer pass counts cross pairs, then merge. Or a Fenwick tree over compressed values. Use 64-bit for 2 × nums[j]. [1,3,2,3,1] → 2. [2,4,3,5,1] → 3. Not 315. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'tags' => ['divide-and-conquer', 'merge-sort', 'binary-indexed-tree', 'step-by-step'],
    'related_guide' => 'reverse-pairs',
];
