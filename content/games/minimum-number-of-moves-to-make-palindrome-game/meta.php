<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Moves to Make Palindrome',
    'leetcode' => 2193,
    'difficulty' => 'Hard',
    'summary' => 'Greedy: match the first character with its last occurrence and move that one to the end (cost = distance). If it has no partner (the odd middle char), it costs ⌊len/2⌋ to move to the center. Repeat on the inner string.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-moves-to-make-palindrome',
    'related_session' => 'minimum-number-of-moves-to-make-palindrome',
];
