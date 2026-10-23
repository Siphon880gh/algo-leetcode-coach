<?php
declare(strict_types=1);

return [
    'title' => 'Soup Servings: recurse on servings of 25 mL',
    'leetcode' => 808,
    'difficulty' => 'Med',
    'summary' => 'Work in units of 25 mL. f(a, b) = average of the four next states (a−4,b), (a−3,b−1), (a−2,b−2), (a−1,b−3). Both empty: 0.5. A empty first: 1. B empty first: 0. For large n the answer is ≈ 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'soup-servings',
    'related_session' => 'soup-servings',
];
