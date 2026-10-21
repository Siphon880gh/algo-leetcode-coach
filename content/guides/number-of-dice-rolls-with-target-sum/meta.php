<?php
declare(strict_types=1);

return [
    'title' => 'Number of Dice Rolls With Target Sum: dice by sum DP',
    'leetcode' => 1155,
    'difficulty' => 'Med',
    'summary' => 'dp[s] counts the ways to reach sum s with the dice so far. Each new die adds faces 1..k, building a fresh row from the old one, modulo 10⁹ + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-dice-rolls-with-target-sum',
];
