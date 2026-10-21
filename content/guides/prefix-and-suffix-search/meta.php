<?php
declare(strict_types=1);

return [
    'title' => 'Prefix and Suffix Search: one trie of suffix#word strings',
    'leetcode' => 745,
    'difficulty' => 'Hard',
    'summary' => 'For every word and each of its suffixes, insert suffix + "#" + word into a trie, storing the largest word index at every node. A query walks suffix + "#" + prefix and reads that node\'s index.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'design', 'strings', 'hash-map', 'leetcode'],
    'related_session' => 'prefix-and-suffix-search',
];
