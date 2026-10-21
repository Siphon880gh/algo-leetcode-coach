<?php
declare(strict_types=1);

return [
    'title' => 'N-Repeated Element: any repeat wins',
    'leetcode' => 961,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: every other value appears once, so the first repeat you see is the answer; a set does it, and so does checking neighbors within distance 3. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'n-repeated-element-in-size-2n-array',
    'tags' => ['hash-table', 'arrays', 'step-by-step'],
];
