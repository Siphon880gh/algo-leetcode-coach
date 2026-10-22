<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Coins for Fruits: buying a free fruit can still pay off',
    'leetcode' => 2944,
    'difficulty' => 'Med',
    'summary' => 'f(i) = cost to get fruits i … n when fruit i is bought: prices[i] plus the best f(j) for the next fruit you buy, j in i + 1 … 2i + 1 (or 0 when everything is covered).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'queue', 'monotonic-queue', 'heap', 'leetcode'],
    'related_session' => 'minimum-number-of-coins-for-fruits',
];
