<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Distances in Tree: reroot with subtree sizes',
    'leetcode' => 834,
    'difficulty' => 'Hard',
    'summary' => 'One DFS computes subtree sizes and the answer for the root. A second DFS moves the root to each child: answer[child] = answer[parent] − size[child] + (n − size[child]), because size[child] nodes get one closer and the rest get one farther.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'dynamic-programming', 'rerooting', 'leetcode'],
    'related_session' => 'sum-of-distances-in-tree',
];
