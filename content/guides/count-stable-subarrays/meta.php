<?php
declare(strict_types=1);

return [
    'title' => 'Count Stable Subarrays: non-decreasing segments',
    'leetcode' => 3748,
    'difficulty' => 'Hard',
    'summary' => 'Stable means non-decreasing. Split nums into maximal non-decreasing segments and keep prefix sums of their k(k + 1)/2 counts. A query is a cut piece at each end plus whole segments between.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'prefix-sum', 'leetcode'],
    'related_session' => 'count-stable-subarrays',
];
