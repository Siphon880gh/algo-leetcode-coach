<?php
declare(strict_types=1);

return [
    'title' => 'Binary Tree Tilt: postorder sums, add |left − right|',
    'leetcode' => 563,
    'difficulty' => 'Easy',
    'summary' => 'A node\'s tilt is |sum of left subtree − sum of right subtree|. Return the total tilt. DFS returns each subtree sum; at each node add |l − r| to the answer and return l + r + val. [1,2,3] → 1. [4,2,9,3,5,null,7] → 15.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'dfs', 'leetcode'],
    'related_session' => 'binary-tree-tilt',
];
