<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Occurrences of a Substring: windows of minSize',
    'leetcode' => 1297,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: only substrings of length minSize matter, so slide that window, keep those with at most maxLetters distinct letters, and return the top frequency. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'maximum-number-of-occurrences-of-a-substring',
    'tags' => ['sliding-window', 'hash-map', 'strings', 'step-by-step'],
];
