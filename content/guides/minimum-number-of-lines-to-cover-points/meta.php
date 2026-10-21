<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Lines to Cover Points: bitmask DP over lines',
    'leetcode' => 2152,
    'difficulty' => 'Med',
    'summary' => 'f(mask) = lines still needed when the points in mask are covered. Take the first uncovered point and either draw a line through it alone, or through it and each other uncovered point, covering every collinear point at once.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'geometry', 'leetcode'],
    'related_session' => 'minimum-number-of-lines-to-cover-points',
];
