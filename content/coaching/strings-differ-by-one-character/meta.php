<?php
declare(strict_types=1);

return [
    'title' => 'Strings Differ by One Character: masked hashes',
    'leetcode' => 1554,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each position, hash each string with that character masked; a repeated masked hash (verified directly) means they differ only there. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'strings-differ-by-one-character',
    'tags' => ['hash-table', 'rolling-hash', 'strings', 'step-by-step'],
];
