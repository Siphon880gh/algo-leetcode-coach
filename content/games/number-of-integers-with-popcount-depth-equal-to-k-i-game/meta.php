<?php
declare(strict_types=1);

return [
    'title' => 'Number of Integers With Popcount-Depth Equal to K I',
    'leetcode' => 3621,
    'difficulty' => 'Hard',
    'summary' => 'After one popcount every number is at most ~50, so depth(x) = 1 + depth(popcount(x)) (depth(1) = 0). The full solution counts, with a binary digit DP, how many x at most n have each popcount; here you trace depths directly.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bits', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-integers-with-popcount-depth-equal-to-k-i',
    'related_session' => 'number-of-integers-with-popcount-depth-equal-to-k-i',
];
