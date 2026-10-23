<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Subsequences After One Inserting: three insertion options',
    'leetcode' => 3628,
    'difficulty' => 'Med',
    'summary' => 'Inserting L is best at the front (adds #CT), T at the end (adds #LC), and C at the split maximizing (L before) · (T after). Take the best gain over the base count.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-number-of-subsequences-after-one-inserting',
];
