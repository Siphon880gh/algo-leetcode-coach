<?php
declare(strict_types=1);

return [
    'title' => 'Inverse Coin Change: rebuild coins from small to large',
    'leetcode' => 3592,
    'difficulty' => 'Med',
    'summary' => 'Go through amounts 1 … n while keeping the ways to make each amount with the coins found so far. If numWays[i] is one more than that, i must be a coin (it adds the single way [i]); if it matches, i is not a coin; anything else is impossible.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'inverse-coin-change',
];
