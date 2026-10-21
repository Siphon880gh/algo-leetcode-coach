<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Special Evenly-Spaced Elements: sqrt decomposition',
    'leetcode' => 1714,
    'difficulty' => 'Hard',
    'summary' => 'Split by step size: for y ≥ √n walk the indices directly (at most √n terms); for small y precompute suffix sums suf[y][i] = nums[i] + suf[y][i + y], grouping queries by y to save memory.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'sqrt-decomposition', 'array', 'leetcode'],
    'related_session' => 'sum-of-special-evenly-spaced-elements-in-array',
];
