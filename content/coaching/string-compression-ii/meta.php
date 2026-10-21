<?php
declare(strict_types=1);

return [
    'title' => 'String Compression II: run-building DP',
    'leetcode' => 1531,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: f(i, k) = min(delete s[i]: f(i+1, k−1); or keep s[i] as a run start: scan j, keep matches, delete others while affordable, add encoded length). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'string-compression-ii',
    'tags' => ['dp', 'strings', 'step-by-step'],
];
