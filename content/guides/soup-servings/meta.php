<?php
declare(strict_types=1);

return [
    'title' => 'Soup Servings: memoize in units of 25 ml, and return 1 for big n',
    'leetcode' => 808,
    'difficulty' => 'Med',
    'summary' => 'All serving amounts are multiples of 25, so scale n down to units. f(a, b) averages the four operations. For large n the probability gets so close to 1 that returning 1 is within tolerance, which caps the work.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'probability', 'memoization', 'math', 'leetcode'],
    'related_session' => 'soup-servings',
];
