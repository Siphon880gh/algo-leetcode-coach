<?php
declare(strict_types=1);

return [
    'title' => 'Delete Operation for Two Strings: keep the LCS',
    'leetcode' => 583,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: what survives is a common subsequence, so the answer is m + n − 2 · LCS, with the usual LCS DP. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'delete-operation-for-two-strings',
    'tags' => ['dynamic-programming', 'strings', 'lcs', 'step-by-step'],
];
