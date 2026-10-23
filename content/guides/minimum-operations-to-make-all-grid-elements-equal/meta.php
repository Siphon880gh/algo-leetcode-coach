<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make All Grid Elements Equal: forced greedy with an unknown target',
    'leetcode' => 3888,
    'difficulty' => 'Hard',
    'summary' => 'Once the final value T is fixed, the operation count at each top-left corner is forced, scanning from the top-left. Carry T as a symbol, so every count is a + b · T, then solve the linear conditions for T.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'matrix', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-all-grid-elements-equal',
];
