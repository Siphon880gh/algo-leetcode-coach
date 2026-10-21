<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Number of Subsequences in a String: add at an end',
    'leetcode' => 2207,
    'difficulty' => 'Med',
    'summary' => 'Count existing pattern pairs in one pass. Adding pattern[0] at the front pairs with every pattern[1], and pattern[1] at the end pairs with every pattern[0]; add the larger count. Equal letters give c(c + 1) / 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['string', 'greedy', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximize-number-of-subsequences-in-a-string',
];
