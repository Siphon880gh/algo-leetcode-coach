<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Prefix Between Adjacent Strings After Removals',
    'leetcode' => 3598,
    'difficulty' => 'Med',
    'summary' => 'Precompute lcp of each adjacent pair, plus prefix and suffix maxima of those values. Removing i kills pairs (i−1, i) and (i, i+1) and creates the new pair (i−1, i+1): answer = max(prefixMax before i−1, suffixMax after i, lcp(words[i−1], words[i+1])).',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-common-prefix-between-adjacent-strings-after-removals',
    'related_session' => 'longest-common-prefix-between-adjacent-strings-after-removals',
];
