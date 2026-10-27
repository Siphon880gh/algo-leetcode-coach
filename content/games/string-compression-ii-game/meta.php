<?php
declare(strict_types=1);

return [
    'title' => 'String Compression II: keep a run, delete the rest of it',
    'leetcode' => 1531,
    'difficulty' => 'Hard',
    'summary' => 'f(i, k) = shortest encoding of s[i..] with k deletions left. Either delete s[i], or keep it and extend its run to j, deleting every different letter in between (if k allows). Run length L costs 1, 2 (L in 2 to 9), 3 (10 to 99)…',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'string-compression-ii',
    'related_session' => 'string-compression-ii',
];
