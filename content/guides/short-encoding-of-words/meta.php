<?php
declare(strict_types=1);

return [
    'title' => 'Short Encoding of Words: drop words that are suffixes of others',
    'leetcode' => 820,
    'difficulty' => 'Med',
    'summary' => 'A word that is a suffix of another word can share its encoding. Put all words in a set, remove every proper suffix of every word, and sum len(word) + 1 over what remains.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'hash-set', 'strings', 'leetcode'],
    'related_session' => 'short-encoding-of-words',
];
