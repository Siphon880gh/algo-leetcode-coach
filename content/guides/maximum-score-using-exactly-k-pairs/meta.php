<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score Using Exactly K Pairs: 3D DP',
    'leetcode' => 3836,
    'difficulty' => 'Hard',
    'summary' => 'f[i][j][t] is the best score using t pairs from the first i of nums1 and the first j of nums2. Skip i, skip j, or pair them. Unreached states start at −∞, so exactly k pairs are forced even when products are negative.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-score-using-exactly-k-pairs',
];
