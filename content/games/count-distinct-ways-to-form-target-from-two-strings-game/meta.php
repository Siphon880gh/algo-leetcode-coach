<?php
declare(strict_types=1);

return [
    'title' => 'Count Distinct Ways to Form Target From Two Strings',
    'leetcode' => 3981,
    'difficulty' => 'Hard',
    'summary' => 'f[t][i][j] counts ways to build target[t..] using word1 from index i and word2 from index j; with suffix sums over i and j each state is O(1). Count all ways, then subtract the ways using only word1 and only word2 (plain subsequence counts).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-distinct-ways-to-form-target-from-two-strings',
    'related_session' => 'count-distinct-ways-to-form-target-from-two-strings',
];
