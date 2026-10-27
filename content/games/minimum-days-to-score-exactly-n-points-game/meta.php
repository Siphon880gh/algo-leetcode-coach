<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Days to Score Exactly N Points',
    'leetcode' => 4050,
    'difficulty' => 'Med',
    'summary' => 'A streak of j days scores j(j + 1) divided by 2 and is followed by one skip, so it costs j + 1 days. Knapsack: f[x] = min over j of f[x − j(j + 1) divided by 2] + j + 1, with f[0] = −1 so the last streak needs no skip.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-days-to-score-exactly-n-points',
    'related_session' => 'minimum-days-to-score-exactly-n-points',
];
