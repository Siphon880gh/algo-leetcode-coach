<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Good Subtree Score: digit-mask knapsack per subtree',
    'leetcode' => 3575,
    'difficulty' => 'Hard',
    'summary' => 'A value can be used only if its digits are distinct; it then owns a 10-bit mask. For each node keep best[mask] over its subtree, merge children by splitting each mask into disjoint parts (submask enumeration), then add the node’s own value.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'leetcode'],
    'related_session' => 'maximum-good-subtree-score',
];
