<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Multiplication Score: four stages',
    'leetcode' => 3290,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = best score having matched a[0 to j] with increasing indices of b. For each b[i], update stages from 3 down to 0: dp[j] = max(dp[j], dp[j−1] + a[j] times b[i]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-multiplication-score',
    'related_session' => 'maximum-multiplication-score',
];
