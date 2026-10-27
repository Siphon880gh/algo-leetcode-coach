<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Paint Sheets',
    'leetcode' => 3802,
    'difficulty' => 'Hard',
    'summary' => 'An ordered pair of colors (i first, j second) with first segment length x needs 1 at most x at most n−1, x at most limit[i] and n − x at most limit[j]: that is max(0, min(limit[i], n−1) − max(1, n − limit[j]) + 1) ways. Sort the capped limits and use prefix sums to add all pairs fast.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-paint-sheets',
    'related_session' => 'number-of-ways-to-paint-sheets',
];
