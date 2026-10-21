<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Removals to Make Mountain Array: LIS from both sides',
    'leetcode' => 1671,
    'difficulty' => 'Hard',
    'summary' => 'For each index, take the longest strictly increasing run ending there (from the left) and the longest strictly decreasing run starting there (to the right). A valid peak needs both ≥ 2; the answer is n − max(L + R − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'binary-search', 'leetcode'],
    'related_session' => 'minimum-number-of-removals-to-make-mountain-array',
];
