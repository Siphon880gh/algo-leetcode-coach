<?php
declare(strict_types=1);

return [
    'title' => 'Replace Words: a trie of roots, shortest match wins',
    'leetcode' => 648,
    'difficulty' => 'Med',
    'summary' => 'Insert every root into a trie. For each word, walk the trie from its first letter and stop at the first node that ends a root; replace the word with that prefix.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'strings', 'hash-table', 'leetcode'],
    'related_session' => 'replace-words',
];
