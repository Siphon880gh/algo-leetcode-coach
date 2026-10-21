<?php
declare(strict_types=1);

return [
    'title' => 'Best Team With No Conflicts: sort by age, LIS-style DP',
    'leetcode' => 1626,
    'difficulty' => 'Med',
    'summary' => 'Sort players by (age, score). Then a team has no conflict exactly when scores are non-decreasing along the order; dp[i] = score[i] + max dp[j] with score[j] ≤ score[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'best-team-with-no-conflicts',
];
