<?php
declare(strict_types=1);

return [
    'title' => 'Sum Game: parity and the 9-per-pair rule',
    'leetcode' => 1927,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: odd number of ? means Alice wins; otherwise Bob wins iff 2 · (s1 − s2) = 9 · (q2 − q1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Game Theory',
    'topic' => 'LeetCode · Game Theory',
    'related_guide' => 'sum-game',
    'tags' => ['game-theory', 'greedy', 'math', 'step-by-step'],
];
