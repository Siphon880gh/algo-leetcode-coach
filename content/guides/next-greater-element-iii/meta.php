<?php
declare(strict_types=1);

return [
    'title' => 'Next Greater Element III: next permutation of the digits, check 32 bits',
    'leetcode' => 556,
    'difficulty' => 'Med',
    'summary' => 'Smallest number larger than n using the same digits, or −1 if none or if it exceeds 2^31 − 1. From the right, find the first i with d[i] < d[i + 1]; swap d[i] with the rightmost digit larger than it; reverse the suffix after i. 12 → 21. 21 → −1. Same as 31.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'two-pointers', 'strings', 'leetcode'],
    'related_session' => 'next-greater-element-iii',
];
