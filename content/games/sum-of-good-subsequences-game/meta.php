<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Good Subsequences: neighbors differ by exactly 1',
    'leetcode' => 3351,
    'difficulty' => 'Hard',
    'summary' => 'cnt[v] / sum[v] = number / total sum of good subsequences ending in value v. For x: c = 1 + cnt[x−1] + cnt[x+1]; s = x·c + sum[x−1] + sum[x+1]. Add them into cnt[x], sum[x].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sum-of-good-subsequences',
    'related_session' => 'sum-of-good-subsequences',
];
