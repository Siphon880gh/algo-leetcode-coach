<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Moves to Make Palindrome: fix the outer pair',
    'leetcode' => 2193,
    'difficulty' => 'Hard',
    'summary' => 'Take the first character, find its last matching copy, and swap that copy to the end; remove both and repeat. If the first character has no partner, it is the middle one: move it one step right and continue.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'string', 'greedy', 'binary-indexed-tree', 'leetcode'],
    'related_session' => 'minimum-number-of-moves-to-make-palindrome',
];
