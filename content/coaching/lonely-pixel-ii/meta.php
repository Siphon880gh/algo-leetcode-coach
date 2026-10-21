<?php
declare(strict_types=1);

return [
    'title' => 'Lonely Pixel II: target counts plus identical rows, grouped by column',
    'leetcode' => 533,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: B at (r, c) counts if row r and column c each have exactly target Bs and every row with a B in column c equals row r. Check column by column; add target when the column passes. Example 1 → 6. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'matrix', 'arrays', 'step-by-step'],
    'related_guide' => 'lonely-pixel-ii',
];
