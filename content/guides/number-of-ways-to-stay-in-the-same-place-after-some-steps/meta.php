<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Stay in the Same Place After Some Steps: capped DP',
    'leetcode' => 1269,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] counts ways to stand at index i. Each step comes from i − 1, i, or i + 1. You can never get farther than steps / 2 and still return, so cap the width at min(arrLen, steps / 2 + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-ways-to-stay-in-the-same-place-after-some-steps',
];
