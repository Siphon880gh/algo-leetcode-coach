<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Food Buckets to Feed the Hamsters: prefer the right side',
    'leetcode' => 2086,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right. Skip a hamster already fed by a bucket on its left; otherwise put a bucket on its right if empty (it may also feed the next hamster), else on its left, else return −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'leetcode'],
    'related_session' => 'minimum-number-of-food-buckets-to-feed-the-hamsters',
];
