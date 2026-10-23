<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make a Rotated Palindrome I: try every rotation',
    'leetcode' => 4021,
    'difficulty' => 'Med',
    'summary' => 'k rotations cost k. Then each mirrored pair costs the shorter way around the letter ring, min(d, 26 − d), because either letter can be incremented.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['math', 'string', 'enumeration', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-a-rotated-palindrome-i',
];
