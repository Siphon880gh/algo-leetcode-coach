<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs Of Nodes: sorted degrees minus shared-edge corrections',
    'leetcode' => 1782,
    'difficulty' => 'Hard',
    'summary' => 'incident(a, b) = deg(a) + deg(b) − shared(a, b). Count pairs with deg sum > q by two pointers on sorted degrees, then, for each connected pair, subtract it if the sum passes but the true value does not.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'graph', 'sorting', 'leetcode'],
    'related_session' => 'count-pairs-of-nodes',
];
