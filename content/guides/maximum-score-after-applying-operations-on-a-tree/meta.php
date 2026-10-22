<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score After Applying Operations on a Tree: take all, keep the cheapest cover',
    'leetcode' => 2925,
    'difficulty' => 'Med',
    'summary' => 'Take every value except a set that leaves something on each root-to-leaf path. keep(u) = values[u] at a leaf, else min(values[u], Σ keep(children)); the answer is the total minus keep(root).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-score-after-applying-operations-on-a-tree',
];
