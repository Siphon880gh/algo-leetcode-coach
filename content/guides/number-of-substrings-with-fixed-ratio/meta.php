<?php
declare(strict_types=1);

return [
    'title' => 'Number of Substrings With Fixed Ratio: equal weighted prefix keys',
    'leetcode' => 2489,
    'difficulty' => 'Med',
    'summary' => 'A substring with z zeros and o ones fits the ratio when z · num2 = o · num1. Track the prefix key num2 · zeros − num1 · ones; every earlier prefix with the same key starts a ratio substring ending here.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'string', 'prefix-sum', 'leetcode'],
    'related_session' => 'number-of-substrings-with-fixed-ratio',
];
