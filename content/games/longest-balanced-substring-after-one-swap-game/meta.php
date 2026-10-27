<?php
declare(strict_types=1);

return [
    'title' => 'Longest Balanced Substring After One Swap',
    'leetcode' => 3900,
    'difficulty' => 'Med',
    'summary' => 'A substring is fine if its ones and zeros already match, or differ by exactly 2 and the outside has a character of the missing kind to swap in. Track prefix balances in a hash map (first index of each balance) and also look up balance ± 2, checking the outside counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-balanced-substring-after-one-swap',
    'related_session' => 'longest-balanced-substring-after-one-swap',
];
