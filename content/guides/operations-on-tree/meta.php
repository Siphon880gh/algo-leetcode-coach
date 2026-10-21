<?php
declare(strict_types=1);

return [
    'title' => 'Operations on Tree: lock map plus child lists',
    'leetcode' => 1993,
    'difficulty' => 'Med',
    'summary' => 'Store the locking user per node and each node\'s children. Lock and unlock are O(1) checks; upgrade walks up for locked ancestors and down (DFS) for locked descendants, clearing them.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'tree', 'dfs', 'leetcode'],
    'related_session' => 'operations-on-tree',
];
