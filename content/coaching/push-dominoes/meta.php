<?php
declare(strict_types=1);

return [
    'title' => 'Push Dominoes: segments between pushes',
    'leetcode' => 838,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each run of dots depends only on the pushes at its two ends; R…L fills inward with an odd middle upright, L…R stays up, and matching ends fill through. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'push-dominoes',
    'tags' => ['two-pointers', 'dynamic-programming', 'strings', 'simulation', 'step-by-step'],
];
