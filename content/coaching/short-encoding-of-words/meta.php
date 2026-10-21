<?php
declare(strict_types=1);

return [
    'title' => 'Short Encoding of Words: remove suffixes',
    'leetcode' => 820,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: only a word that is a suffix of another can share its encoding, so delete every proper suffix and sum len + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'short-encoding-of-words',
    'tags' => ['trie', 'hash-set', 'strings', 'step-by-step'],
];
