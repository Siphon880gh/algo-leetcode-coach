<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Reward Using Operations II: big-integer bitset',
    'leetcode' => 3181,
    'difficulty' => 'Hard',
    'summary' => 'Same reachable-sum DP as version I, stored as one big bitset: f |= (f & ((1 << v) − 1)) << v.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximum-total-reward-using-operations-ii',
];
