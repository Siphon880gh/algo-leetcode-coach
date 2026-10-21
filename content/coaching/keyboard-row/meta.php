<?php
declare(strict_types=1);

return [
    'title' => 'Keyboard Row: map letters to row numbers, check one row',
    'leetcode' => 500,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: words typable with one keyboard row (qwertyuiop / asdfghjkl / zxcvbnm), ignoring case. Map each letter to a row; keep a word whose letters all map to the row of its first letter. ["Hello","Alaska","Dad","Peace"] → ["Alaska","Dad"]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'strings', 'step-by-step'],
    'related_guide' => 'keyboard-row',
];
