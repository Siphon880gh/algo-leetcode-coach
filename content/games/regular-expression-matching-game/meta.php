<?php
declare(strict_types=1);

return [
    'title' => 'Regular Expression Matching: a star means zero copies or one more',
    'leetcode' => 10,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j]: does s[0..i) match p[0..j)? A letter or "." must match s[i−1] and inherit dp[i−1][j−1]. "x*" is either skipped (dp[i][j−2]) or eats one more matching letter (dp[i−1][j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'regular-expression-matching',
    'related_session' => 'regular-expression-matching',
];
