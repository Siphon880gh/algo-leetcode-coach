<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindrome After Substring Concatenation II: the same DP at n = 1000',
    'leetcode' => 3504,
    'difficulty' => 'Hard',
    'summary' => 'Same plan as part I: the mirrored part comes from f[i][j], and the extra middle is the longest palindrome starting right after it in s or ending right before it in t. Build both palindrome tables by expanding around centers.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['mini-game', 'leetcode', 'dynamic-programming'],
    'entry' => 'index.html',
    'related_guide' => 'longest-palindrome-after-substring-concatenation-ii',
    'related_session' => 'longest-palindrome-after-substring-concatenation-ii',
];
