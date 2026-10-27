<?php
declare(strict_types=1);

return [
    'title' => 'Remove K-Balanced Substrings',
    'leetcode' => 3703,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of runs (char, length). Push each character, merging with an equal top run. When a ")" run reaches k and the run below is "(" with at least k, delete k of each; the runs that meet afterwards merge naturally.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'remove-k-balanced-substrings',
    'related_session' => 'remove-k-balanced-substrings',
];
