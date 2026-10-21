<?php
declare(strict_types=1);

return [
    'title' => 'Longest Word in Dictionary: every prefix must be a word',
    'leetcode' => 720,
    'difficulty' => 'Med',
    'summary' => 'A word counts only if all its prefixes are in the list. Sort the words, keep a set of buildable words, and accept a word when its prefix without the last letter is buildable. Take the longest, alphabetically first on ties.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'hash-set', 'sorting', 'strings', 'leetcode'],
    'related_session' => 'longest-word-in-dictionary',
];
