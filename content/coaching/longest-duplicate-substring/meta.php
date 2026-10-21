<?php
declare(strict_types=1);

return [
    'title' => 'Longest Duplicate Substring: binary search plus rolling hash',
    'leetcode' => 1044,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: a duplicate of length L implies one of length L − 1, so binary search L and test each length with rolling hashes, verifying any match. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'longest-duplicate-substring',
    'tags' => ['strings', 'binary-search', 'rolling-hash', 'suffix-array', 'step-by-step'],
];
