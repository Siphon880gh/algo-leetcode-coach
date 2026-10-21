<?php
declare(strict_types=1);

return [
    'title' => 'Count The Repetitions: per-start scan of s1, then a cycle',
    'leetcode' => 466,
    'difficulty' => 'Hard',
    'summary' => 'str1 is s1 repeated n1 times, str2 is s2 repeated n2 times. Find the largest m such that str2 repeated m times is a subsequence of str1. For each position j in s2, precompute how many full s2 copies one pass over s1 finishes and where in s2 it ends. Chain n1 passes, total the copies, divide by n2. "acb", 4, "ab", 2 → 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'simulation', 'leetcode'],
    'related_session' => 'count-the-repetitions',
];
