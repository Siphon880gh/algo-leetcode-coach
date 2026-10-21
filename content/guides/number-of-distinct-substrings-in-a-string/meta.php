<?php
declare(strict_types=1);

return [
    'title' => 'Number of Distinct Substrings in a String: trie or rolling hash',
    'leetcode' => 1698,
    'difficulty' => 'Med',
    'summary' => 'Insert every suffix into a trie and count created nodes (O(n²)); for better, use a suffix automaton or suffix array where the count is Σ (n − sa[i]) − Σ lcp.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'kind' => 'algo',
    'tags' => ['trie', 'rolling-hash', 'suffix-array', 'string', 'leetcode'],
    'related_session' => 'number-of-distinct-substrings-in-a-string',
];
