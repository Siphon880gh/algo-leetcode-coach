<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Perfect Square Ancestors',
    'leetcode' => 3715,
    'difficulty' => 'Hard',
    'summary' => 'a × b is a square exactly when a and b have the same square-free kernel (remove every squared prime factor). DFS from the root keeping a count of kernels on the current path; node i adds the count of its own kernel among its ancestors.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sum-of-perfect-square-ancestors',
    'related_session' => 'sum-of-perfect-square-ancestors',
];
