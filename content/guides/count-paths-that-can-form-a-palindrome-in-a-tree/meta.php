<?php
declare(strict_types=1);

return [
    'title' => 'Count Paths That Can Form a Palindrome in a Tree: parity masks',
    'leetcode' => 2791,
    'difficulty' => 'Hard',
    'summary' => 'Give each node the XOR mask of letter parities on its root path. A path u–v can be rearranged into a palindrome when mask[u] XOR mask[v] has at most one bit; count matching earlier masks with a hash map.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'tree', 'depth-first-search', 'hash-table', 'leetcode'],
    'related_session' => 'count-paths-that-can-form-a-palindrome-in-a-tree',
];
