<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Binary Tree: a decreasing stack',
    'leetcode' => 654,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: recursion on the max works but costs O(n²) on sorted input; a decreasing stack links each node in O(n). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'maximum-binary-tree',
    'tags' => ['stack', 'monotonic-stack', 'trees', 'divide-and-conquer', 'step-by-step'],
];
