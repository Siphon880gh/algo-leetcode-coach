<?php
declare(strict_types=1);

return [
    'title' => 'Map of Highest Peak: multi-source BFS from water',
    'leetcode' => 1765,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: enqueue all water cells at height 0 and BFS; each land cell gets its distance to the nearest water. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Breadth-First Search',
    'topic' => 'LeetCode · Breadth-First Search',
    'related_guide' => 'map-of-highest-peak',
    'tags' => ['breadth-first-search', 'matrix', 'step-by-step'],
];
