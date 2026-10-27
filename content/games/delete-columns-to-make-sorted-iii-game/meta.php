<?php
declare(strict_types=1);

return [
    'title' => 'Delete Columns to Make Sorted III: LIS over columns',
    'leetcode' => 960,
    'difficulty' => 'Hard',
    'summary' => 'Keep a set of columns where every row is non-decreasing. dp[j] = longest kept chain ending at column j, built from columns i < j where every row has s[i] at most s[j]. Delete m − max dp.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'delete-columns-to-make-sorted-iii',
    'related_session' => 'delete-columns-to-make-sorted-iii',
];
