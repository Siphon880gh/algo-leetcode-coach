<?php
declare(strict_types=1);

return [
    'title' => 'Describe the Painting: sweep over endpoints',
    'leetcode' => 1943,
    'difficulty' => 'Med',
    'summary' => 'Add each colour at its start and subtract at its end in a map. Walk the sorted endpoints with a running sum; emit [x_i, x_{i+1}, sum] when the sum is positive. Every endpoint is a boundary, even if the sum does not change.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'sorting', 'sweep-line', 'leetcode'],
    'related_session' => 'describe-the-painting',
];
