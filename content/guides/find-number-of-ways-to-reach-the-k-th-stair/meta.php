<?php
declare(strict_types=1);

return [
    'title' => 'Find Number of Ways to Reach the K-th Stair: choose where the downs go',
    'leetcode' => 3154,
    'difficulty' => 'Hard',
    'summary' => 'After j up moves Alice has climbed to 2^j. Up to j + 1 single downs fit in the gaps without two in a row, so k is reached with d = 2^j − k downs in C(j + 1, d) ways.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'memoization', 'math', 'dynamic-programming', 'combinatorics', 'leetcode'],
    'related_session' => 'find-number-of-ways-to-reach-the-k-th-stair',
];
