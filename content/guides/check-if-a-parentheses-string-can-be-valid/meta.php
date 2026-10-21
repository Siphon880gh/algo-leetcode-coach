<?php
declare(strict_types=1);

return [
    'title' => 'Check if a Parentheses String Can Be Valid: two greedy sweeps',
    'leetcode' => 2116,
    'difficulty' => 'Med',
    'summary' => 'Odd length is impossible. Sweep left to right treating every unlocked character as ( and fail if a prefix still has more ) than that; sweep right to left treating unlocked characters as ) and fail on the mirror condition.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'stack', 'string', 'leetcode'],
    'related_session' => 'check-if-a-parentheses-string-can-be-valid',
];
