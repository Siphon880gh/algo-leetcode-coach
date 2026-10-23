<?php
declare(strict_types=1);

return [
    'title' => 'No Consecutive Ones: count by the highest differing bit',
    'leetcode' => 600,
    'difficulty' => 'Hard',
    'summary' => 'f[k] = binary strings of length k with no "11" (Fibonacci). Walk n\'s bits from the top: at each 1-bit at position k, add f[k] (put 0 there, anything valid below). Stop if two 1s are adjacent; otherwise count n itself.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'non-negative-integers-without-consecutive-ones',
    'related_session' => 'non-negative-integers-without-consecutive-ones',
];
