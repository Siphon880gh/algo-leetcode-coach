<?php
declare(strict_types=1);

return [
    'title' => 'Coin Path: cheapest cost to the end, ties to the smaller index',
    'leetcode' => 656,
    'difficulty' => 'Hard',
    'summary' => 'Work backwards: cost[i] = coins[i] + min cost[j] for j in i+1..i+maxJump (skip −1 cells). Taking the first j on ties makes the path lexicographically smallest.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'coin-path',
    'related_session' => 'coin-path',
];
