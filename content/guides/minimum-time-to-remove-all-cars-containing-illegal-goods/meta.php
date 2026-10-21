<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Remove All Cars Containing Illegal Goods: prefix cost plus suffix',
    'leetcode' => 2167,
    'difficulty' => 'Hard',
    'summary' => 'Let pre be the cheapest way to clear s[0 … i]: either remove all i + 1 cars from the left, or extend the previous best and pay 2 for an illegal car at i. Everything after i is removed from the right, at cost n − 1 − i.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-time-to-remove-all-cars-containing-illegal-goods',
];
