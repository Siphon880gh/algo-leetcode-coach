<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Cameras: three states, leaves up',
    'leetcode' => 968,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: a post-order pass returns not covered, has camera, or covered; place a camera exactly when a child is not covered, and check the root at the end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'binary-tree-cameras',
    'tags' => ['trees', 'greedy', 'depth-first-search', 'dynamic-programming', 'step-by-step'],
];
