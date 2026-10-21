<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning III: cost table, then split DP',
    'leetcode' => 1278,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: precompute cost[i][j], the changes to make s[i..j] a palindrome, then f(i, k) = min over j of cost[i][j] + f(j + 1, k − 1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'palindrome-partitioning-iii',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];
