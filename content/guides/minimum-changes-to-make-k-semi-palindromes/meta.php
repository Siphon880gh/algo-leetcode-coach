<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Changes to Make K Semi-palindromes: cost table, then partition DP',
    'leetcode' => 2911,
    'difficulty' => 'Hard',
    'summary' => 'cost[i][j] is the fewest changes to make s[i … j) a semi-palindrome: the best over divisors d < length of the mismatched pairs in each residue class. Then split into k parts with a DP.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'two-pointers', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-changes-to-make-k-semi-palindromes',
];
