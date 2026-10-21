<?php
declare(strict_types=1);

return [
    'title' => 'Find the Kth Smallest Sum of a Matrix With Sorted Rows: merge rows, keep k',
    'leetcode' => 1439,
    'difficulty' => 'Hard',
    'summary' => 'Fold the rows together: combine the current best k sums with the next row, keep only the k smallest, and repeat. The answer is the k-th of the final list.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'matrix', 'leetcode'],
    'related_session' => 'find-the-kth-smallest-sum-of-a-matrix-with-sorted-rows',
];
