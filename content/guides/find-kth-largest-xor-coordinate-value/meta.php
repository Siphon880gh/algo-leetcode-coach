<?php
declare(strict_types=1);

return [
    'title' => 'Find Kth Largest XOR Coordinate Value: 2D prefix XOR',
    'leetcode' => 1738,
    'difficulty' => 'Med',
    'summary' => 'Each value is a 2D prefix XOR: P[i][j] = P[i−1][j] ^ P[i][j−1] ^ P[i−1][j−1] ^ matrix[i][j]. Collect all m · n values and select the kth largest.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'bit-manipulation', 'matrix', 'leetcode'],
    'related_session' => 'find-kth-largest-xor-coordinate-value',
];
