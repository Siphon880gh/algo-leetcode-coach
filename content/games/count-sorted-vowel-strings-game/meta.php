<?php
declare(strict_types=1);

return [
    'title' => 'Count Sorted Vowel Strings: how many end with each vowel',
    'leetcode' => 1641,
    'difficulty' => 'Med',
    'summary' => 'cnt[v] = sorted strings ending in vowel v. Next length: new cnt[v] = the sum of cnt[u] for u at most v (a running prefix sum).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-sorted-vowel-strings',
    'related_session' => 'count-sorted-vowel-strings',
];
