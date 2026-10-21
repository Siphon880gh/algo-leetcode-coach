<?php
declare(strict_types=1);

return [
    'title' => 'Duplicate Zeros: fill from the back',
    'leetcode' => 1089,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: count the zeros, then copy from the end with a second index that runs ahead by that count, writing zeros twice and skipping writes past the end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'duplicate-zeros',
    'tags' => ['two-pointers', 'arrays', 'step-by-step'],
];
