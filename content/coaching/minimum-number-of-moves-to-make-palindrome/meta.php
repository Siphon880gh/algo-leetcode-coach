<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Moves to Make Palindrome: outer pairs first',
    'leetcode' => 2193,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: pair the first character with its last copy, shift an unpaired middle character one step at a time, and stay greedy in O(n²). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-number-of-moves-to-make-palindrome',
    'tags' => ['two-pointers', 'string', 'greedy', 'binary-indexed-tree', 'step-by-step'],
];
