<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence Repeated k Times',
    'leetcode' => 2014,
    'difficulty' => 'Hard',
    'summary' => 'Only letters with count ≥ k can appear, and the answer is short (≤ n/k). BFS over candidates by length, extending with each usable letter and keeping those where candidate·k is a subsequence; the last level\'s lexicographically largest wins.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-subsequence-repeated-k-times',
    'related_session' => 'longest-subsequence-repeated-k-times',
];
