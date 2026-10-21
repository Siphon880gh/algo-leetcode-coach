<?php
declare(strict_types=1);

return [
    'title' => 'Best Sightseeing Pair: split the score by index',
    'leetcode' => 1014,
    'difficulty' => 'Med',
    'summary' => 'The score values[i] + i + values[j] − j separates into a part for i and a part for j. Walk j forward, keeping the best values[i] + i seen so far, and combine it with values[j] − j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'best-sightseeing-pair',
];
