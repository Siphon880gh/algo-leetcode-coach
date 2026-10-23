<?php
declare(strict_types=1);

return [
    'title' => 'Count k-Free Subsets: independent chains, Fibonacci each',
    'leetcode' => 2638,
    'difficulty' => 'Med',
    'summary' => 'Values only conflict within the same residue mod k, and only neighbors differing by exactly k. Split sorted values into chains of consecutive +k steps; a chain of length L has Fib(L + 2) independent subsets. Multiply.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-k-free-subsets',
    'related_session' => 'count-the-number-of-k-free-subsets',
];
