<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Array Modulo Alternating II',
    'leetcode' => 3944,
    'difficulty' => 'Hard',
    'summary' => 'k is now up to 10^5, so you cannot price every residue element by element. Sort the residues of each parity class; the cost as a function of x is piecewise linear, so sweep x over 0..k−1 with prefix sums (handling wraparound) to get every total, then combine the best and second-best x ≠ y.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-make-array-modulo-alternating-ii',
    'related_session' => 'minimum-operations-to-make-array-modulo-alternating-ii',
];
