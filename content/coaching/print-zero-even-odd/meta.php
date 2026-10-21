<?php
declare(strict_types=1);

return [
    'title' => 'Print Zero Even Odd: route every turn through zero',
    'leetcode' => 1116,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: zero holds the first turn, prints 0, and wakes the odd or even thread by parity; that thread prints its number and hands the turn back. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'related_guide' => 'print-zero-even-odd',
    'tags' => ['concurrency', 'threads', 'semaphore', 'step-by-step'],
];
