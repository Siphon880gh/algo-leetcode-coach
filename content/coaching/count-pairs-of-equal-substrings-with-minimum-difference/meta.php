<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs of Equal Substrings With Minimum Difference: single characters win',
    'leetcode' => 1794,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: only single letters can be optimal; for each letter take its first index in the first string minus its last index in the second, and count letters reaching the minimum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'count-pairs-of-equal-substrings-with-minimum-difference',
    'tags' => ['greedy', 'hash-table', 'string', 'step-by-step'],
];
