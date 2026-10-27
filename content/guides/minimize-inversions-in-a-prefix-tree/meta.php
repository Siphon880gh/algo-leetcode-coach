<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Inversions in a Prefix Tree: pairwise child costs and a bitmask order',
    'leetcode' => 4077,
    'difficulty' => 'Hard',
    'summary' => 'Inversions across two child subtrees depend only on which child goes first, so price every pair of children and pick the best child order with a bitmask DP at each node.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'string', 'dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'minimize-inversions-in-a-prefix-tree',
];
