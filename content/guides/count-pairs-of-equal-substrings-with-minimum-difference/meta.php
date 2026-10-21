<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs of Equal Substrings With Minimum Difference: single characters win',
    'leetcode' => 1794,
    'difficulty' => 'Med',
    'summary' => 'Lengthening a match only increases j − a, so optimal quadruples are single characters. For each letter, j − a is minimised by its first index in the first string and its last index in the second; count letters achieving the overall minimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'string', 'leetcode'],
    'related_session' => 'count-pairs-of-equal-substrings-with-minimum-difference',
];
