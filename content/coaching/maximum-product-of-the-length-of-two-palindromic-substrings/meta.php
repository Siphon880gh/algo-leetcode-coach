<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of Two Palindromic Substrings: Manacher plus best-by-side',
    'leetcode' => 1960,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: Manacher radii, longest odd palindrome ending by i and starting from i, then max product across each cut. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'maximum-product-of-the-length-of-two-palindromic-substrings',
    'tags' => ['string', 'manacher', 'prefix-sum', 'step-by-step'],
];
