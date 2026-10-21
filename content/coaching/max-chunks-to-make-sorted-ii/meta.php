<?php
declare(strict_types=1);

return [
    'title' => 'Max Chunks To Make Sorted II: merge into the stack',
    'leetcode' => 768,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: a stack of chunk maxima, push when x ≥ top, otherwise merge every chunk whose max exceeds x and keep the biggest max. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'max-chunks-to-make-sorted-ii',
    'tags' => ['monotonic-stack', 'stack', 'greedy', 'arrays', 'step-by-step'],
];
