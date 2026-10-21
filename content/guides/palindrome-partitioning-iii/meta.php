<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning III: cost table plus partition DP',
    'leetcode' => 1278,
    'difficulty' => 'Hard',
    'summary' => 'Precompute cost[i][j], the number of changes to make s[i..j] a palindrome. Then f(i, k) is the cheapest way to split s[i:] into k palindromes: try each end j for the first piece.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'palindrome-partitioning-iii',
];
