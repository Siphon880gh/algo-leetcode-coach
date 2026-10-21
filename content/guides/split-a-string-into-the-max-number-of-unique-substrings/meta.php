<?php
declare(strict_types=1);

return [
    'title' => 'Split a String Into the Max Number of Unique Substrings: backtracking',
    'leetcode' => 1593,
    'difficulty' => 'Med',
    'summary' => 'Try every next cut, keep a set of used pieces, and recurse; n ≤ 16 makes exhaustive search fine. Prune when used + remaining characters cannot beat the best.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'hash-set', 'string', 'leetcode'],
    'related_session' => 'split-a-string-into-the-max-number-of-unique-substrings',
];
