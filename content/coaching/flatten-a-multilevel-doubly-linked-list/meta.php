<?php
declare(strict_types=1);

return [
    'title' => 'Flatten a Multilevel Doubly Linked List: splice child before next, then continue',
    'leetcode' => 430,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: flatten a doubly linked list whose nodes may have child lists. A child list goes right after its parent and before the parent’s old next. Save next, splice the flattened child in, connect its tail to the saved next, clear child. Not 114 / 426. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'tags' => ['linked-list', 'dfs', 'doubly-linked-list', 'step-by-step'],
    'related_guide' => 'flatten-a-multilevel-doubly-linked-list',
];
