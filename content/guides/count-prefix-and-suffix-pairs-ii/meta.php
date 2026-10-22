<?php
declare(strict_types=1);

return [
    'title' => 'Count Prefix and Suffix Pairs II: trie of character pairs',
    'leetcode' => 3045,
    'difficulty' => 'Hard',
    'summary' => 'words[i] is a prefix and a suffix of words[j] exactly when, for every k, the pair (s[k], s[len − 1 − k]) of words[i] matches that of words[j]. Insert each word’s pairs into a trie; while walking, add the count of earlier words that end at each node.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'array', 'string', 'string-matching', 'hash-function', 'rolling-hash', 'leetcode'],
    'related_session' => 'count-prefix-and-suffix-pairs-ii',
];
