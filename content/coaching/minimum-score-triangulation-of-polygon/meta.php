<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Score Triangulation of Polygon: fix an edge',
    'leetcode' => 1039,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: edge (i, j) lies in one triangle with apex k between them, so dp[i][j] = min over k of dp[i][k] + dp[k][j] + v[i] · v[k] · v[j]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-score-triangulation-of-polygon',
    'tags' => ['dynamic-programming', 'interval-dp', 'arrays', 'step-by-step'],
];
