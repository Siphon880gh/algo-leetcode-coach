<?php
declare(strict_types=1);

return [
    'title' => 'Distribute Coins in Binary Tree: count the flow across each edge',
    'leetcode' => 979,
    'difficulty' => 'Med',
    'summary' => 'Each subtree has an excess: coins minus nodes. That many coins must cross the edge to its parent, one move each. A post-order pass returns the excess and adds |left excess| + |right excess| to the moves.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'depth-first-search', 'leetcode'],
    'related_session' => 'distribute-coins-in-binary-tree',
];
