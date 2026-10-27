<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of Subsequences With an Alternating Sum Equal to K',
    'leetcode' => 3509,
    'difficulty' => 'Hard',
    'summary' => 'DP over states (alternating sum, sign of the next pick, product capped at limit+1). Each number either starts a subsequence, extends a state with the next sign, or is skipped. A 0 resets any product, even an over-limit one.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-product-of-subsequences-with-an-alternating-sum-equal-to-k',
    'related_session' => 'maximum-product-of-subsequences-with-an-alternating-sum-equal-to-k',
];
