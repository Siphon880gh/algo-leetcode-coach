<?php
declare(strict_types=1);

return [
    'title' => 'Make Array Strictly Increasing: last value to fewest operations',
    'leetcode' => 1187,
    'difficulty' => 'Hard',
    'summary' => 'Process arr1 left to right with a map from the last kept value to the fewest operations. Each state either keeps arr1[i] if it is larger, or replaces it with the smallest arr2 value above the last one.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'make-array-strictly-increasing',
];
