<?php
declare(strict_types=1);

return [
    'title' => 'Closest Fair Integer: same length first, else the smallest longer one',
    'leetcode' => 2417,
    'difficulty' => 'Med',
    'summary' => 'Odd-length numbers are never fair. For an even length, keep the longest prefix of n you can, raise one digit, and fill the rest with 0s then 1s as needed; if no same-length answer exists, use the smallest fair number two digits longer.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'enumeration', 'leetcode'],
    'related_session' => 'closest-fair-integer',
];
