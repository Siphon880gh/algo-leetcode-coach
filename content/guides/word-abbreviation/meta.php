<?php
declare(strict_types=1);

return [
    'title' => 'Word Abbreviation: group by (length, first, last), prefix = 1 + longest common prefix',
    'leetcode' => 527,
    'difficulty' => 'Hard',
    'summary' => 'Abbreviate each word as prefix + count + last char, growing the prefix until unique; keep the word if the abbreviation is not shorter. Only words with the same length, first and last letter can clash. In each group, a word needs prefix length 1 + its longest common prefix with any other (trie counts or sorted neighbors). "internal" stays; "internet" → "i6t".',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'strings', 'sorting', 'greedy', 'leetcode'],
    'related_session' => 'word-abbreviation',
];
