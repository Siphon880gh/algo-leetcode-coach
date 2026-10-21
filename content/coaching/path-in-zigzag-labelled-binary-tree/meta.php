<?php
declare(strict_types=1);

return [
    'title' => 'Path In Zigzag Labelled Binary Tree: reflect, then halve',
    'leetcode' => 1104,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: at each row, mirror the label within the row with lo + hi − label, halve it to get the parent, and collect labels up to 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'path-in-zigzag-labelled-binary-tree',
    'tags' => ['trees', 'math', 'binary-tree', 'step-by-step'],
];
