<?php
declare(strict_types=1);

return [
    'title' => 'Broken Calculator: halve backward',
    'leetcode' => 991,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: run the operations backward from target, halving when even and adding 1 when odd, until target ≤ startValue; then add the remaining gap. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'broken-calculator',
    'tags' => ['greedy', 'math', 'step-by-step'],
];
