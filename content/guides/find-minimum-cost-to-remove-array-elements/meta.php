<?php
declare(strict_types=1);

return [
    'title' => 'Find Minimum Cost to Remove Array Elements: one leftover plus the next two',
    'leetcode' => 3469,
    'difficulty' => 'Med',
    'summary' => 'After each removal the first three are one leftover element j and the next two untouched ones i and i + 1. dp(i, j) tries the three pairs to remove, so there are O(n²) states.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-minimum-cost-to-remove-array-elements',
];
