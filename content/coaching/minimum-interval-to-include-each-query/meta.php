<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Interval to Include Each Query: sweep with a heap',
    'leetcode' => 1851,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort intervals and queries, push started intervals by size, pop expired ones lazily. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'minimum-interval-to-include-each-query',
    'tags' => ['heap', 'sorting', 'line-sweep', 'step-by-step'],
];
