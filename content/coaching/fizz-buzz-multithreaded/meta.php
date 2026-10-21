<?php
declare(strict_types=1);

return [
    'title' => 'Fizz Buzz Multithreaded: shared counter with a condition',
    'leetcode' => 1195,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep i under one condition, let each thread wait until i is past n or is its own kind, print, increment, and notify all. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'related_guide' => 'fizz-buzz-multithreaded',
    'tags' => ['concurrency', 'design', 'step-by-step'],
];
