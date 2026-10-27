<?php
declare(strict_types=1);

return [
    'title' => 'Count All Possible Routes: memo on (city, fuel)',
    'leetcode' => 1575,
    'difficulty' => 'Hard',
    'summary' => 'f(city, fuel) = (city == finish ? 1 : 0) + the sum of f(next, fuel − |loc[city] − loc[next]|) over other cities with enough fuel.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-all-possible-routes',
    'related_session' => 'count-all-possible-routes',
];
