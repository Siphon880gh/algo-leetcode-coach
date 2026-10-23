<?php
declare(strict_types=1);

return [
    'title' => 'Verbal Arithmetic Puzzle',
    'leetcode' => 1307,
    'difficulty' => 'Hard',
    'summary' => 'Give each letter a weight = Σ place values in the words − place values in the result; we need Σ weight·digit = 0. Backtrack over letters (largest |weight| first) with distinct digits, no leading zeros, pruning by the max remaining contribution.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'verbal-arithmetic-puzzle',
    'related_session' => 'verbal-arithmetic-puzzle',
];
