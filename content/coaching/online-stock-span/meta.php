<?php
declare(strict_types=1);

return [
    'title' => 'Online Stock Span: fold smaller days in',
    'leetcode' => 901,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep (price, span) pairs on a stack with decreasing prices; a new price pops every price ≤ it and adds their spans. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'online-stock-span',
    'tags' => ['monotonic-stack', 'design', 'stack', 'step-by-step'],
];
