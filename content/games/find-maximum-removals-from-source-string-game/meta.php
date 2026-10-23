<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Removals: keep pattern alive, remove the rest',
    'leetcode' => 3316,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = most removable target indices while matching pattern[0..j) in source so far. Each source char either is removed (+1 if it is a target index) or matches pattern[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-maximum-removals-from-source-string',
    'related_session' => 'find-maximum-removals-from-source-string',
];
