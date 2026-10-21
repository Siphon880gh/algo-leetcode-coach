<?php
declare(strict_types=1);

return [
    'title' => 'Coin Path: DP from the end, smallest next index on ties',
    'leetcode' => 656,
    'difficulty' => 'Hard',
    'summary' => 'f[i] is the cheapest cost from i to the end. Fill it backward, always picking the smallest j that reaches the minimum, so following the chosen next pointers from 1 gives the lexicographically smallest cheapest path.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'coin-path',
];
