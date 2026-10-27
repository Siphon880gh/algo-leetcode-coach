<?php
declare(strict_types=1);

return [
    'title' => 'Subsequence After One Replacement',
    'leetcode' => 3983,
    'difficulty' => 'Med',
    'summary' => 'pre[i] = where in t the greedy match of s[0..i) ends, suf[i] = where the greedy match of s[i..] from the right begins. Replacing s[i] works if some character of t lies strictly between pre[i] and suf[i + 1], i.e. pre[i] < suf[i + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'subsequence-after-one-replacement',
    'related_session' => 'subsequence-after-one-replacement',
];
