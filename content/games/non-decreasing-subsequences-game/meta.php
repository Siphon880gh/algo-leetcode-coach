<?php
declare(strict_types=1);

return [
    'title' => 'Non-decreasing Subsequences',
    'leetcode' => 491,
    'difficulty' => 'Med',
    'summary' => 'Backtrack from index i: at each level use a set so the same value is not chosen twice as the next element; extend only with values at least the last. Record paths of length at least 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'non-decreasing-subsequences',
    'related_session' => 'non-decreasing-subsequences',
];
