<?php
declare(strict_types=1);

return [
    'title' => 'Subsequence With the Minimum Score: prefix and suffix matches',
    'leetcode' => 2565,
    'difficulty' => 'Hard',
    'summary' => 'Deleting everything between left and right costs the same as deleting only some of it, so remove one block of t. Match prefixes of t greedily from the left of s and suffixes from the right, then find the shortest middle block with two pointers.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'string', 'binary-search', 'leetcode'],
    'related_session' => 'subsequence-with-the-minimum-score',
];
