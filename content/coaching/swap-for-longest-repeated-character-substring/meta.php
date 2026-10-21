<?php
declare(strict_types=1);

return [
    'title' => 'Swap For Longest Repeated Character Substring: runs, gaps, caps',
    'leetcode' => 1156,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count every letter, split into runs, try extending a run by one and joining two runs across a one-letter gap, and cap each by the letter\'s total. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'swap-for-longest-repeated-character-substring',
    'tags' => ['strings', 'sliding-window', 'hash-table', 'step-by-step'],
];
