<?php
declare(strict_types=1);

return [
    'title' => 'Put Boxes Into the Warehouse II: effective heights from both ends',
    'leetcode' => 1580,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: effective height = max(prefix min, suffix min); sort effective heights and boxes; greedily match the smallest boxes. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'put-boxes-into-the-warehouse-ii',
    'tags' => ['greedy', 'sorting', 'step-by-step'],
];
