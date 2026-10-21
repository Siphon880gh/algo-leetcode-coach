<?php
declare(strict_types=1);

return [
    'title' => 'Number of Distinct Roll Sequences: DP on the last two rolls',
    'leetcode' => 2318,
    'difficulty' => 'Hard',
    'summary' => 'State (previous roll, last roll). Extend with a value coprime to the last roll and different from both of the last two. Sum all states after n rolls; n = 1 gives 6.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'memoization', 'leetcode'],
    'related_session' => 'number-of-distinct-roll-sequences',
];
