<?php
declare(strict_types=1);

return [
    'title' => 'Solving Questions With Brainpower: DP from the end',
    'leetcode' => 2140,
    'difficulty' => 'Med',
    'summary' => 'f(i) = best points from question i on: skip it (f(i + 1)) or solve it (points + f(i + brainpower + 1)). Fill from the back in 64-bit.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'solving-questions-with-brainpower',
];
