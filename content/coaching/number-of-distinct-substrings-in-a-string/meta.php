<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Substrings: count new trie nodes',
    'leetcode' => 1698,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: insert every suffix into a trie and count created nodes; a suffix automaton gives O(n). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'number-of-distinct-substrings-in-a-string',
    'tags' => ['trie', 'rolling-hash', 'suffix-array', 'string', 'step-by-step'],
];
