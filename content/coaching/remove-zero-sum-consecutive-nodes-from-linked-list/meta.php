<?php
declare(strict_types=1);

return [
    'title' => 'Remove Zero Sum Consecutive Nodes: prefix sums twice',
    'leetcode' => 1171,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add a dummy, record the last node for each prefix sum, then relink each node to the node after the last one with its prefix sum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'related_guide' => 'remove-zero-sum-consecutive-nodes-from-linked-list',
    'tags' => ['linked-list', 'prefix-sum', 'hash-table', 'step-by-step'],
];
