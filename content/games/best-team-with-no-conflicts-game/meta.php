<?php
declare(strict_types=1);

return [
    'title' => 'Best Team With No Conflicts: sort by age, then non-decreasing scores',
    'leetcode' => 1626,
    'difficulty' => 'Med',
    'summary' => 'Sort by (age, score). A team is valid if scores never decrease along that order. dp[i] = score[i] + best dp[j] with j < i and score[j] at most score[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'best-team-with-no-conflicts',
    'related_session' => 'best-team-with-no-conflicts',
];
