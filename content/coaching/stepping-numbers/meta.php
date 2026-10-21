<?php
declare(strict_types=1);

return [
    'title' => 'Stepping Numbers: BFS from single digits',
    'leetcode' => 1215,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add 0 if low is 0, BFS from 1–9 appending the last digit ± 1, skip numbers above high, and keep those at least low. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'stepping-numbers',
    'tags' => ['bfs', 'math', 'step-by-step'],
];
