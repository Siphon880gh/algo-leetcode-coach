<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Increment Operations to Make Array Beautiful: DP over the last raised index',
    'leetcode' => 2919,
    'difficulty' => 'Med',
    'summary' => 'Every window of 3 needs one value ≥ k, so the raised indices are never more than 2 apart. dp[i] = cost to raise i plus the best of the previous three dp values.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-increment-operations-to-make-array-beautiful',
];
