<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points After Collecting Coins From All Nodes: DP on node and halvings',
    'leetcode' => 2920,
    'difficulty' => 'Hard',
    'summary' => 'The state is the node and how many halvings its ancestors applied. Coins are below 2^14, so after 14 halvings everything is 0 and the state can be capped.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'tree', 'depth-first-search', 'leetcode'],
    'related_session' => 'maximum-points-after-collecting-coins-from-all-nodes',
];
