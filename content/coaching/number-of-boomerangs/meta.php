<?php
declare(strict_types=1);

return [
    'title' => 'Number of Boomerangs: per center, count equal distances',
    'leetcode' => 447,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count ordered triples (i, j, k) with dist(i, j) = dist(i, k). For each center i, count squared distances in a hash map; c points at one distance give c(c − 1) ordered pairs. [[0,0],[1,0],[2,0]] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'math', 'geometry', 'step-by-step'],
    'related_guide' => 'number-of-boomerangs',
];
