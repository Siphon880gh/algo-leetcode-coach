<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence Repeated k Times: grow candidates',
    'leetcode' => 2014,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: only characters with ≥ k copies, BFS by length, prefixes stay valid, largest of the longest wins. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'longest-subsequence-repeated-k-times',
    'tags' => ['backtracking', 'bfs', 'string', 'greedy', 'step-by-step'],
];
