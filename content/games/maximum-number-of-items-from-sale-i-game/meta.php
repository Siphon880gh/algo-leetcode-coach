<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Items From Sale I',
    'leetcode' => 3946,
    'difficulty' => 'Med',
    'summary' => 'Buying at least one copy of item i earns one free copy of each other item whose factor it divides, once. So the first copy of i is worth 1 + bonus_i and extra copies are worth 1. Run a knapsack over the budget where each item is a group: skip it, or take c at least 1 copies for value c + bonus_i.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-items-from-sale-i',
    'related_session' => 'maximum-number-of-items-from-sale-i',
];
