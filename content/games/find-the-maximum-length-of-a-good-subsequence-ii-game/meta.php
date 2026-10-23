<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of a Good Subsequence II: best per value and per change count',
    'leetcode' => 3177,
    'difficulty' => 'Hard',
    'summary' => 'Same dp[i][j], but keep best[j] over all values and bestByValue[v][j] so each step is O(k): dp = max(byValue[v][j] + 1, best[j−1] + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-maximum-length-of-a-good-subsequence-ii',
    'related_session' => 'find-the-maximum-length-of-a-good-subsequence-ii',
];
