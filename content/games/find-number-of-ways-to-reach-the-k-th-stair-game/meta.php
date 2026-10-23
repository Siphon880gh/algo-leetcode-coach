<?php
declare(strict_types=1);

return [
    'title' => 'Ways to Reach the k-th Stair: count ups and downs',
    'leetcode' => 3154,
    'difficulty' => 'Hard',
    'summary' => 'After j up-jumps (1 + 2 + … + 2^(j−1)) and d single downs, Alice stands on 2^j − d. Downs cannot be consecutive, so they fit into j + 1 gaps: C(j + 1, d) ways. Sum over j with d = 2^j − k in [0, j + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-number-of-ways-to-reach-the-k-th-stair',
    'related_session' => 'find-number-of-ways-to-reach-the-k-th-stair',
];
