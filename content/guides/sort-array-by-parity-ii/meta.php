<?php
declare(strict_types=1);

return [
    'title' => 'Sort Array By Parity II: fix even slots with odd-slot partners',
    'leetcode' => 922,
    'difficulty' => 'Easy',
    'summary' => 'Walk i over even indices. When nums[i] is odd, move j along odd indices to the next even value and swap. Each misplaced odd at an even slot pairs with a misplaced even at an odd slot.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'arrays', 'sorting', 'leetcode'],
    'related_session' => 'sort-array-by-parity-ii',
];
