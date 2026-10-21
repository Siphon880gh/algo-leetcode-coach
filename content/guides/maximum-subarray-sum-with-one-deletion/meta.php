<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum with One Deletion: keep and deleted states',
    'leetcode' => 1186,
    'difficulty' => 'Med',
    'summary' => 'Track two running bests ending at each index: keep (no deletion yet, plain Kadane) and deleted (one element removed). Deleted extends itself or drops the current element after keep.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'maximum-subarray-sum-with-one-deletion',
];
