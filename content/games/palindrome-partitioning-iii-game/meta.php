<?php
declare(strict_types=1);

return [
    'title' => 'Palindrome Partitioning III: change cost, then split',
    'leetcode' => 1278,
    'difficulty' => 'Hard',
    'summary' => 'cost[i][j] = changes to make s[i..j] a palindrome (mismatched mirror pairs). dp[p][j] = best for the first j letters in p parts = min over i of dp[p−1][i] + cost[i][j−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'palindrome-partitioning-iii',
    'related_session' => 'palindrome-partitioning-iii',
];
