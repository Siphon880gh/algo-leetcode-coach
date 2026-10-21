<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Missing Genetic Value in Each Subtree: walk up from value 1',
    'leetcode' => 2003,
    'difficulty' => 'Hard',
    'summary' => 'Only ancestors of the node holding 1 can miss something other than 1. Walk from that node up to the root, adding each newly covered subtree\'s values to a seen set (visiting each node once), and advance the missing pointer monotonically.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'dfs', 'hash-table', 'leetcode'],
    'related_session' => 'smallest-missing-genetic-value-in-each-subtree',
];
