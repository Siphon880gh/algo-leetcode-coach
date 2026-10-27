<?php
declare(strict_types=1);

return [
    'title' => 'Trionic Array II',
    'leetcode' => 3640,
    'difficulty' => 'Hard',
    'summary' => 'Three running DP values ending at i: up1 (a rising run of length at least 2), down (up1 then a strict fall), up2 (down then a strict rise). Each extends the previous phase or itself when the step direction fits; the answer is the max up2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'trionic-array-ii',
    'related_session' => 'trionic-array-ii',
];
