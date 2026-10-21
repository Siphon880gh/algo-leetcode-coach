<?php
declare(strict_types=1);

return [
    'title' => 'Lonely Pixel II: target counts plus identical rows, grouped by column',
    'leetcode' => 533,
    'difficulty' => 'Med',
    'summary' => 'A B at (r, c) counts if row r and column c both have exactly target blacks, and every row with a B in column c equals row r. Count blacks per row and column, and keep each row as a string. For each column with target blacks, take its first black row r; if rows[r] == target and all its black rows equal row r, add target. Example 1 → 6.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'matrix', 'arrays', 'leetcode'],
    'related_session' => 'lonely-pixel-ii',
];
