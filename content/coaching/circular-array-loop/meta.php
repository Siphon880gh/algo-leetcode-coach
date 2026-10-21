<?php
declare(strict_types=1);

return [
    'title' => 'Circular Array Loop: fast and slow pointers, one direction, length more than 1',
    'leetcode' => 457,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: from i you jump nums[i] steps around the circle. Is there a cycle longer than 1 with all values of one sign? Floyd slow/fast from each start while the sign holds; a meeting point that is not a self-loop means true. Zero out failed paths for O(n). [2,−1,1,2,2] → true. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'arrays', 'cycle-detection', 'step-by-step'],
    'related_guide' => 'circular-array-loop',
];
