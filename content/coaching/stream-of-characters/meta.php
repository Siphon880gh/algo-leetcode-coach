<?php
declare(strict_types=1);

return [
    'title' => 'Stream of Characters: reversed trie',
    'leetcode' => 1032,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: store words reversed in a trie, keep the last maxLen letters, and on each query walk the trie from the newest letter backward. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'stream-of-characters',
    'tags' => ['trie', 'design', 'strings', 'step-by-step'],
];
