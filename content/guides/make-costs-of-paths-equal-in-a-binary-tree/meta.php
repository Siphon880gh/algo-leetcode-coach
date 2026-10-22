<?php
declare(strict_types=1);

return [
    'title' => 'Make Costs of Paths Equal in a Binary Tree: fix siblings bottom-up',
    'leetcode' => 2673,
    'difficulty' => 'Med',
    'summary' => 'Two sibling subtrees must end with equal path sums, and raising the smaller one at its root is cheapest. Go bottom-up: add |left − right| increments, then pass the larger sum up.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'tree', 'array', 'dynamic-programming', 'binary-tree', 'leetcode'],
    'related_session' => 'make-costs-of-paths-equal-in-a-binary-tree',
];
