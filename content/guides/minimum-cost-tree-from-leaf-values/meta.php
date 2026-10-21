<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Tree From Leaf Values: remove the smallest first',
    'leetcode' => 1130,
    'difficulty' => 'Med',
    'summary' => 'Each non-leaf costs the product of the largest leaves on its two sides. Greedily remove the smallest leaf, paying it times the smaller of its neighbours; a decreasing stack finds those removals in one pass.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'monotonic-stack', 'greedy', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-cost-tree-from-leaf-values',
];
