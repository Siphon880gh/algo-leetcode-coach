<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Prefix After at Most One Removal: skip one mismatch in s',
    'leetcode' => 3460,
    'difficulty' => 'Med',
    'summary' => 'Walk both strings together. At the first mismatch, skip that character of s once and keep going; at a second mismatch, stop. The matched length in t is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'string', 'leetcode'],
    'related_session' => 'longest-common-prefix-after-at-most-one-removal',
];
