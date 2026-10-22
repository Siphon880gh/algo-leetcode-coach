<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Substring With Identical Characters I: try each length',
    'leetcode' => 3398,
    'difficulty' => 'Hard',
    'summary' => 'For a target length L ≥ 2, a run of m equal characters needs ⌊m / (L + 1)⌋ flips. L = 1 means the string must alternate, so compare with 0101… and 1010…. With n ≤ 1000, try L = 1, 2, … until the flips fit.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'enumeration', 'leetcode'],
    'related_session' => 'smallest-substring-with-identical-characters-i',
];
