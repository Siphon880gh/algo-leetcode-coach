<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Cameras: greedy from the leaves up',
    'leetcode' => 968,
    'difficulty' => 'Hard',
    'summary' => 'Never put a camera on a leaf; its parent covers more. A post-order pass returns one of three states: not covered, has a camera, or covered. Place a camera at a node exactly when a child is not covered.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'greedy', 'depth-first-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'binary-tree-cameras',
];
