<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Sum With Length Divisible by K',
    'leetcode' => 3381,
    'difficulty' => 'Med',
    'summary' => 'A subarray (i, j] has length divisible by k iff i ≡ j (mod k). Keep the minimum prefix sum for each index class mod k; at j, best = prefix[j] − minPrefix[j mod k].',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-sum-with-length-divisible-by-k',
    'related_session' => 'maximum-subarray-sum-with-length-divisible-by-k',
];
