<?php
declare(strict_types=1);

return [
    'title' => 'Count Nodes That Are Great Enough: keep the k smallest per subtree',
    'leetcode' => 2792,
    'difficulty' => 'Hard',
    'summary' => 'Work bottom-up, keeping each subtree’s k smallest values. A node counts when its descendants supply at least k values and the k-th smallest of them is below the node’s value.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'heap', 'leetcode'],
    'related_session' => 'count-nodes-that-are-great-enough',
];
