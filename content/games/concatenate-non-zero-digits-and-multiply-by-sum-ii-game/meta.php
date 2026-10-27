<?php
declare(strict_types=1);

return [
    'title' => 'Concatenate Non-Zero Digits and Multiply by Sum II',
    'leetcode' => 3756,
    'difficulty' => 'Med',
    'summary' => 'Prefix arrays over s: X[i] = concatenation of non-zero digits (mod p), C[i] = how many there are, S[i] = digit sum. For [l, r]: x = X[r+1] − X[l] times 10 to the power (C[r+1] − C[l]) and sum = S[r+1] − S[l].',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'concatenate-non-zero-digits-and-multiply-by-sum-ii',
    'related_session' => 'concatenate-non-zero-digits-and-multiply-by-sum-ii',
];
