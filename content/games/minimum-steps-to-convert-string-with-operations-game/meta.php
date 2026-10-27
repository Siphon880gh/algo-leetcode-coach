<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Steps to Convert String with Operations',
    'leetcode' => 3579,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = min over j of dp[j] + cost(word1[j..i−1] → word2[j..i−1]). A piece costs (mismatches − swappable pairs), where a pair a→b and b→a is fixed by one swap; or 1 more for reversing it first.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-steps-to-convert-string-with-operations',
    'related_session' => 'minimum-steps-to-convert-string-with-operations',
];
