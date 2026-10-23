<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR of Subsequences: XOR linear basis',
    'leetcode' => 3681,
    'difficulty' => 'Hard',
    'summary' => 'Every subsequence XOR lies in the span of nums, and so does X XOR Y; taking Y empty reaches any value in the span. So the answer is the largest XOR in the span, found greedily with a linear basis.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'array', 'math', 'leetcode'],
    'related_session' => 'maximum-xor-of-subsequences',
];
