<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score of Non-Overlapping Intervals: up to 4, smallest indices',
    'leetcode' => 3414,
    'difficulty' => 'Hard',
    'summary' => 'Sort by end; dp[c][i] = best (score, sorted index list) using c intervals among the first i, comparing score first and then index lists lexicographically. Taking an interval jumps to the last one ending before its start.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-score-of-non-overlapping-intervals',
    'related_session' => 'maximum-score-of-non-overlapping-intervals',
];
