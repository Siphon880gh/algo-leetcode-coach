<?php
declare(strict_types=1);

return [
    'title' => 'Index Pairs of a String: trie walk from each start',
    'leetcode' => 1065,
    'difficulty' => 'Easy',
    'summary' => 'Put the words in a trie. From each start i, walk the trie along text and record [i, j] whenever the node at j marks a word end; stop as soon as the trie has no next letter.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'strings', 'leetcode'],
    'related_session' => 'index-pairs-of-a-string',
];
