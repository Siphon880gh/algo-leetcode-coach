<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest Valid Sequence: one change allowed',
    'leetcode' => 3302,
    'difficulty' => 'Med',
    'summary' => 'suf[i] = how many trailing letters of word2 can be matched (exactly) in word1[i..]. Scan word1: take index i if it matches the next letter, or if the one change is still free and the rest of word2 fits in suf[i+1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-lexicographically-smallest-valid-sequence',
    'related_session' => 'find-the-lexicographically-smallest-valid-sequence',
];
