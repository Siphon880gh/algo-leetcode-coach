<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make a Rotated Palindrome II',
    'leetcode' => 4028,
    'difficulty' => 'Hard',
    'summary' => 'n is now 5·10^4, so you cannot re-price all n rotations pair by pair. Treat the string as cyclic: rotation r pairs position r + i with r − 1 − i. Group the pair costs by i + j mod n (the "anti-diagonal" each rotation uses), computed with 26 convolutions or an FFT over letter indicators, then add r.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-make-a-rotated-palindrome-ii',
    'related_session' => 'minimum-operations-to-make-a-rotated-palindrome-ii',
];
