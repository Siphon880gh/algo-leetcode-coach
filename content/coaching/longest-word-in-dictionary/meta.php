<?php
declare(strict_types=1);

return [
    'title' => 'Longest Word in Dictionary: buildable one letter at a time',
    'leetcode' => 720,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort, keep a set of buildable words seeded with "", accept a word when its prefix is buildable, and prefer longer then smaller. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'longest-word-in-dictionary',
    'tags' => ['trie', 'hash-set', 'sorting', 'strings', 'step-by-step'],
];
