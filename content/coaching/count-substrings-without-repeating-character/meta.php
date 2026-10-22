<?php
declare(strict_types=1);

return [
    'title' => 'Count Substrings Without Repeating Character: jump past the old copy, add the window',
    'leetcode' => 2743,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: move the left edge just past the earlier copy, and add the whole window length for each right end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'count-substrings-without-repeating-character',
    'tags' => ['hash-table', 'string', 'sliding-window', 'step-by-step'],
];
