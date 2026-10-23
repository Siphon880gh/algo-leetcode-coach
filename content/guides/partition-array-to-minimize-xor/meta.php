<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array to Minimize XOR: DP over cut points',
    'leetcode' => 3599,
    'difficulty' => 'Med',
    'summary' => 'f[i][j] = the best maximum XOR splitting the first i elements into j pieces. The last piece is h … i − 1, with XOR pre[i] ^ pre[h].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'partition-array-to-minimize-xor',
];
