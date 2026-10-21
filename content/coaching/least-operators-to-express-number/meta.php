<?php
declare(strict_types=1);

return [
    'title' => 'Least Operators to Express Number: base-x digits with carry',
    'leetcode' => 964,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: read target in base x; build each digit with d copies of x^i or x − d copies plus a carry, keeping the cheapest cost of both states. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'least-operators-to-express-number',
    'tags' => ['dynamic-programming', 'math', 'step-by-step'],
];
