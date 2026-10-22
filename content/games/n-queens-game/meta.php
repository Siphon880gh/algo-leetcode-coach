<?php
declare(strict_types=1);

return [
    'title' => 'N-Queens: one queen per row, backtrack when a row is blocked',
    'leetcode' => 51,
    'difficulty' => 'Hard',
    'summary' => 'Fill rows top to bottom. In each row, place the queen in the leftmost safe column (after the last one you tried). A column or diagonal already attacked is unsafe. If no column is safe, backtrack: lift the previous queen and try further right.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'n-queens',
    'related_session' => 'n-queens',
];
