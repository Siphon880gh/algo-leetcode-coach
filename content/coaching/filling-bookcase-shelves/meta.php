<?php
declare(strict_types=1);

return [
    'title' => 'Filling Bookcase Shelves: last shelf DP',
    'leetcode' => 1105,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i] tries every last shelf ending at book i, growing it leftward while the width fits and tracking its tallest book. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'filling-bookcase-shelves',
    'tags' => ['dynamic-programming', 'arrays', 'step-by-step'],
];
