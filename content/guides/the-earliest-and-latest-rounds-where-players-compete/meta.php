<?php
declare(strict_types=1);

return [
    'title' => 'Earliest and Latest Rounds Where Players Compete: memoised search over positions',
    'leetcode' => 1900,
    'difficulty' => 'Hard',
    'summary' => 'Only the two stars\' positions and the row length matter. For each state, try every outcome of the other matches, recompute where the stars land in the next round, and take min/max over results. Memoise on (n, i, j).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'memoization', 'brute-force', 'leetcode'],
    'related_session' => 'the-earliest-and-latest-rounds-where-players-compete',
];
