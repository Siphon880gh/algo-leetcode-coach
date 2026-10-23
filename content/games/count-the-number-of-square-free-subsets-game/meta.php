<?php
declare(strict_types=1);

return [
    'title' => 'Count Square-Free Subsets: prime masks must be disjoint',
    'leetcode' => 2572,
    'difficulty' => 'Med',
    'summary' => 'A usable value is square-free (a prime mask). dp[mask] = subsets whose product uses exactly these primes. Each element joins a subset if its mask is disjoint. Answer: every non-empty subset counted.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-square-free-subsets',
    'related_session' => 'count-the-number-of-square-free-subsets',
];
