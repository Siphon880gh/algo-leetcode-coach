<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make a Rotated Palindrome II: all rotations at once with FFT',
    'leetcode' => 4028,
    'difficulty' => 'Hard',
    'summary' => 'After k rotations, every mirrored pair comes from original positions p and q with p + q ≡ 2k + n − 1 (mod n). So the pairing cost of every rotation is a cyclic convolution: for each letter x, convolve where x appears with Σ_y cost(x, y) · (where y appears).',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['math', 'string', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-a-rotated-palindrome-ii',
];
