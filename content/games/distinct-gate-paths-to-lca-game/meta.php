<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Gate Paths to LCA',
    'leetcode' => 3973,
    'difficulty' => 'Hard',
    'summary' => 'Climbing from u to its parent is a 2 by 2 transition on (card colour): red stays red through red gates, flips through white gates, and likewise for blue. A person\'s ways are the product of these matrices from their start up to (not including) the LCA. Binary lifting stores the matrix products for 2 to the power j jumps; multiply Alice\'s and Bob\'s totals and XOR over queries.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'distinct-gate-paths-to-lca',
    'related_session' => 'distinct-gate-paths-to-lca',
];
