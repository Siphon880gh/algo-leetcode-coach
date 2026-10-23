<?php
declare(strict_types=1);

return [
    'title' => 'Choose K Elements With Maximum Sum: sort by nums1, keep the top k in a heap',
    'leetcode' => 3478,
    'difficulty' => 'Med',
    'summary' => 'Process indices in increasing nums1. Before adding a group of equal nums1 values, each of them answers with the current sum of the k largest nums2 seen so far; a min-heap of size k keeps that sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'choose-k-elements-with-maximum-sum',
];
