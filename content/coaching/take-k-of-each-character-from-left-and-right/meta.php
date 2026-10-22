<?php
declare(strict_types=1);

return [
    'title' => 'Take K of Each Character From Left and Right: leave total − k, check feasibility first',
    'leetcode' => 2516,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: let the middle keep up to total[c] − k of each letter, and return −1 before sliding when a letter is too rare. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'take-k-of-each-character-from-left-and-right',
    'tags' => ['hash-table', 'string', 'sliding-window', 'step-by-step'],
];
