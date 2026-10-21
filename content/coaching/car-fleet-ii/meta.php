<?php
declare(strict_types=1);

return [
    'title' => 'Car Fleet II: monotonic stack from the right',
    'leetcode' => 1776,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: go right to left; pop cars that are not slower, or that merge before we could reach them; the remaining top gives our collision time. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'car-fleet-ii',
    'tags' => ['monotonic-stack', 'math', 'array', 'step-by-step'],
];
