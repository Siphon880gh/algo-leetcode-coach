<?php
declare(strict_types=1);

return [
    'title' => 'Recover a Tree From Preorder Traversal: stack by depth',
    'leetcode' => 1028,
    'difficulty' => 'Hard',
    'summary' => 'Parse each node as a dash count (its depth) and a value. Keep a stack holding the current path; pop until its size equals the depth, then attach the node to the top as left child if free, else right.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['trees', 'stack', 'strings', 'leetcode'],
    'related_session' => 'recover-a-tree-from-preorder-traversal',
];
