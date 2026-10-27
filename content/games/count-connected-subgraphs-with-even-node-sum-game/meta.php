<?php
declare(strict_types=1);

return [
    'title' => 'Count Connected Subgraphs With Even Node Sum',
    'leetcode' => 3910,
    'difficulty' => 'Hard',
    'summary' => 'n ≤ 13, so enumerate all 2^n − 1 subsets as bitmasks. Skip odd sums (popcount of the mask ANDed with the 1-valued nodes), and check connectivity with a BFS restricted to the mask.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-connected-subgraphs-with-even-node-sum',
    'related_session' => 'count-connected-subgraphs-with-even-node-sum',
];
