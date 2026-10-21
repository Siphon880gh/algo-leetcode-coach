<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of the Length of Two Palindromic Substrings: Manacher + prefix/suffix best',
    'leetcode' => 1960,
    'difficulty' => 'Hard',
    'summary' => 'Manacher gives the odd-palindrome radius at every centre. Build pre[i] = longest odd palindrome ending at or before i and suf[i] = longest starting at or after i (propagating shrinking palindromes by −2 per step). Answer = max pre[i] · suf[i + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'kind' => 'algo',
    'tags' => ['string', 'manacher', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-product-of-the-length-of-two-palindromic-substrings',
];
