<?php
declare(strict_types=1);

return [
    'title' => 'Max Sum of a Pair With Equal Sum of Digits: keep the largest per digit sum',
    'leetcode' => 2342,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: group by digit sum, pair each number with the largest seen so far, and return −1 when no group has two. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'max-sum-of-a-pair-with-equal-sum-of-digits',
    'tags' => ['array', 'hash-table', 'sorting', 'heap', 'step-by-step'],
];
