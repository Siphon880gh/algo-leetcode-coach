<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game VIII: best prefix choice from the right',
    'leetcode' => 1872,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: every move scores a prefix sum; f = max(f, p[i] − f) from the right, starting at p[n]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stone-game-viii',
    'tags' => ['dynamic-programming', 'game-theory', 'prefix-sum', 'step-by-step'],
];
