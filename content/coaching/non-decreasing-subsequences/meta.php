<?php
declare(strict_types=1);

return [
    'title' => 'Non-decreasing Subsequences: backtrack, skip repeated choices at each depth',
    'leetcode' => 491,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: all distinct non-decreasing subsequences with length ≥ 2. Backtrack over the next index ≥ start whose value is at least the last one, but use each value once per depth with a small set. Record paths of length ≥ 2. [4,6,7,7] → 8 lists. Not 300 / 90. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'hash-table', 'step-by-step'],
    'related_guide' => 'non-decreasing-subsequences',
];
