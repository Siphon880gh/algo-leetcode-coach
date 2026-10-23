<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Score Triangulation: pick the third vertex of edge (i, j)',
    'leetcode' => 1039,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] = cheapest triangulation of vertices i..j. Edge (i, j) belongs to one triangle (i, m, j): dp[i][m] + dp[m][j] + v[i]·v[m]·v[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-score-triangulation-of-polygon',
    'related_session' => 'minimum-score-triangulation-of-polygon',
];
