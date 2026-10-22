<?php
declare(strict_types=1);

return [
    'title' => 'Edit Distance: free on a match, else 1 + cheapest edit',
    'leetcode' => 72,
    'difficulty' => 'Med',
    'summary' => 'Match → copy the diagonal (no cost). Otherwise 1 + min(replace = diagonal, delete = up, insert = left). Row 0 and column 0 are just counts of inserts or deletes.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'edit-distance',
    'related_session' => 'edit-distance',
];
