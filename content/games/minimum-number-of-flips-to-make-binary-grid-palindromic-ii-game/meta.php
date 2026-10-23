<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Flips to Make Binary Grid Palindromic II',
    'leetcode' => 3240,
    'difficulty' => 'Med',
    'summary' => 'Each group of 4 mirrored cells must be equal: cost min(ones, 4 − ones). The middle row/column (odd sizes) has mirrored pairs: d mismatched pairs, and o ones in matching pairs. If o % 4 == 0 pay d; else pay d if d > 0 (one mismatch becomes 11) or 2. The center cell must be 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-flips-to-make-binary-grid-palindromic-ii',
    'related_session' => 'minimum-number-of-flips-to-make-binary-grid-palindromic-ii',
];
