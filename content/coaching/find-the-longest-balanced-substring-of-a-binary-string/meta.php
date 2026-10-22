<?php
declare(strict_types=1);

return [
    'title' => 'Find the Longest Balanced Substring of a Binary String: 2 · min of adjacent runs',
    'leetcode' => 2609,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: score a 0-run and the 1-run right after it by 2 · min, and never combine runs across the string. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'find-the-longest-balanced-substring-of-a-binary-string',
    'tags' => ['string', 'step-by-step'],
];
