<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Integers on a Grid Path: digit DP with the last path digit',
    'leetcode' => 3906,
    'difficulty' => 'Hard',
    'summary' => 'D and R both move to a later position in row-major order, so the 7 path cells are 7 of the 16 digit positions, in order. Count x ≤ N with a digit DP that remembers the last path digit, then take F(r) − F(l − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'count-good-integers-on-a-grid-path',
];
