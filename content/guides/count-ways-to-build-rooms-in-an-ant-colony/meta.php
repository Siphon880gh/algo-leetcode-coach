<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Build Rooms in an Ant Colony: n! / Π subtree sizes',
    'leetcode' => 1916,
    'difficulty' => 'Hard',
    'summary' => 'Valid orders are topological orders of a rooted tree: each room must come after its parent. Their count is n! divided by the product of all subtree sizes, computed mod p with modular inverses.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'kind' => 'algo',
    'tags' => ['combinatorics', 'tree', 'dfs', 'math', 'leetcode'],
    'related_session' => 'count-ways-to-build-rooms-in-an-ant-colony',
];
