<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Tree From Leaf Values: decreasing stack',
    'leetcode' => 1130,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a decreasing stack, and when a larger value arrives, pop smaller ones and pay each times the smaller of its two neighbours; finish by pairing what remains. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'minimum-cost-tree-from-leaf-values',
    'tags' => ['stack', 'monotonic-stack', 'greedy', 'dynamic-programming', 'step-by-step'],
];
