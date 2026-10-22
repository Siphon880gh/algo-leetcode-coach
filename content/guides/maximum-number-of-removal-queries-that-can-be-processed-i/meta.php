<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Removal Queries That Can Be Processed I: DP over removed ends',
    'leetcode' => 3018,
    'difficulty' => 'Hard',
    'summary' => 'Choosing a subsequence up front is the same as skipping elements freely at either end. So let f[i][j] be the most queries processed after taking i elements from the left and j from the right; extend from f[i − 1][j] or f[i][j − 1], adding 1 when that element meets the next query.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-number-of-removal-queries-that-can-be-processed-i',
];
