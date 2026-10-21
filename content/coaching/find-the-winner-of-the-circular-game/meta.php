<?php
declare(strict_types=1);

return [
    'title' => 'Find the Winner of the Circular Game: Josephus recurrence',
    'leetcode' => 1823,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: r = 0; for i = 2 … n, r = (r + k) % i; answer r + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'find-the-winner-of-the-circular-game',
    'tags' => ['math', 'recursion', 'simulation', 'step-by-step'],
];
