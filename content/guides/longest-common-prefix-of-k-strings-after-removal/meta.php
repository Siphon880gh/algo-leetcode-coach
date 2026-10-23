<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Prefix of K Strings After Removal: trie counts and the deepest good node',
    'leetcode' => 3485,
    'difficulty' => 'Hard',
    'summary' => 'A depth d works when some trie node there has count ≥ k. Removing one word only lowers counts on its path, so the deepest answer D changes only for the k words through the single such node at D.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['trie', 'array', 'string', 'leetcode'],
    'related_session' => 'longest-common-prefix-of-k-strings-after-removal',
];
