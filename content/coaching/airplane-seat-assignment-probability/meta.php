<?php
declare(strict_types=1);

return [
    'title' => 'Airplane Seat Assignment Probability: seat 1 versus seat n',
    'leetcode' => 1227,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: note that the process ends when seat 1 or seat n is taken, that both are equally likely at every step, and answer 1 for n = 1 and 0.5 otherwise. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'airplane-seat-assignment-probability',
    'tags' => ['math', 'probability', 'dynamic-programming', 'step-by-step'],
];
