<?php
declare(strict_types=1);

return [
    'title' => 'Unique Substrings in Wraparound String: longest run ending at each letter',
    'leetcode' => 467,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count distinct substrings of s that appear in …xyzabc…. A valid substring is fixed by its last letter and length. Track the current run length k; keep the longest run ending at each letter; sum the 26 maxima. "zab" → 6. "cac" → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
    'related_guide' => 'unique-substrings-in-wraparound-string',
];
