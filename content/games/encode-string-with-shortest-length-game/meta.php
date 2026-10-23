<?php
declare(strict_types=1);

return [
    'title' => 'Encode String with Shortest Length: best of split or repeat',
    'leetcode' => 471,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = shortest encoding of s[i..j]. Either split it into two encoded parts, or, if it is a repeated pattern, write k[pattern] with the pattern encoded.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'encode-string-with-shortest-length',
    'related_session' => 'encode-string-with-shortest-length',
];
