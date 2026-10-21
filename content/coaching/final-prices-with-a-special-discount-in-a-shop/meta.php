<?php
declare(strict_types=1);

return [
    'title' => 'Final Prices With a Special Discount: monotonic stack',
    'leetcode' => 1475,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: keep a stack of indices still waiting for a discount; each new price ≤ the top pays that discount. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'final-prices-with-a-special-discount-in-a-shop',
    'tags' => ['stack', 'monotonic-stack', 'step-by-step'],
];
