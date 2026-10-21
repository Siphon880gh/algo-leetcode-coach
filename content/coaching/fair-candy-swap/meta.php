<?php
declare(strict_types=1);

return [
    'title' => 'Fair Candy Swap: x − y = (sumA − sumB) / 2',
    'leetcode' => 888,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: equal totals after the swap force x − y = (sumA − sumB) / 2, so put Bob\'s sizes in a set and look up x − delta for each of Alice\'s. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'fair-candy-swap',
    'tags' => ['hash-table', 'math', 'arrays', 'step-by-step'],
];
