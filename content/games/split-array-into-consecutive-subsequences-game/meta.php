<?php
declare(strict_types=1);

return [
    'title' => 'Split Array into Consecutive Subsequences',
    'leetcode' => 659,
    'difficulty' => 'Med',
    'summary' => 'Greedy with counts and "ends": for each x, extend a subsequence ending at x − 1 if possible; otherwise start x, x+1, x+2 (fail if missing). (A heap per end value also works.)',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'split-array-into-consecutive-subsequences',
    'related_session' => 'split-array-into-consecutive-subsequences',
];
