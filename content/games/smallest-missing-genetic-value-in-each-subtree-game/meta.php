<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Missing Genetic Value: only ancestors of the 1',
    'leetcode' => 2003,
    'difficulty' => 'Hard',
    'summary' => 'Subtrees without value 1 answer 1. Only the path from the node holding 1 up to the root matters: walk up, adding each new subtree\'s values to a set and advancing the missing pointer.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-missing-genetic-value-in-each-subtree',
    'related_session' => 'smallest-missing-genetic-value-in-each-subtree',
];
