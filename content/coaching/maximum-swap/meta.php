<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Swap: the last occurrence of the biggest larger digit',
    'leetcode' => 670,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: record each digit\'s last index, find the leftmost position that can grow, and swap with the last copy of the largest larger digit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-swap',
    'tags' => ['greedy', 'math', 'arrays', 'step-by-step'],
];
