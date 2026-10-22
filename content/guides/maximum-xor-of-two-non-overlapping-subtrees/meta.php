<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR of Two Non-Overlapping Subtrees: subtree sums and a binary trie during DFS',
    'leetcode' => 2479,
    'difficulty' => 'Hard',
    'summary' => 'Compute every subtree sum first. Then DFS again: before entering a node, query a binary trie holding the sums of subtrees already finished, which are exactly the ones disjoint from it; insert the node’s sum after its children are done.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'graph', 'trie', 'leetcode'],
    'related_session' => 'maximum-xor-of-two-non-overlapping-subtrees',
];
