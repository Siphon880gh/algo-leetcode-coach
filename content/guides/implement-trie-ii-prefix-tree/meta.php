<?php
declare(strict_types=1);

return [
    'title' => 'Implement Trie II (Prefix Tree): counts on every node',
    'leetcode' => 1804,
    'difficulty' => 'Med',
    'summary' => 'Store on each node how many words pass through it and how many end there. Insert and erase walk the word adjusting both counters; the queries read them at the final node (0 if the path is missing).',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'design', 'hash-table', 'leetcode'],
    'related_session' => 'implement-trie-ii-prefix-tree',
];
