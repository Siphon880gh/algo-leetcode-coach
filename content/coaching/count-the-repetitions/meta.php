<?php
declare(strict_types=1);

return [
    'title' => 'Count The Repetitions: per-start scan of s1, then a cycle',
    'leetcode' => 466,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: str1 = s1 × n1, str2 = s2 × n2; largest m with str2 × m a subsequence of str1. For each pointer j in s2, precompute how many s2 copies one pass of s1 finishes and where j ends. Chain n1 passes, total copies, divide by n2. "acb", 4, "ab", 2 → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'strings', 'simulation', 'step-by-step'],
    'related_guide' => 'count-the-repetitions',
];
