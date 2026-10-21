<?php
declare(strict_types=1);

return [
    'title' => '132 Pattern: scan right to left with a decreasing stack and the best "2"',
    'leetcode' => 456,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: is there i < j < k with nums[i] < nums[k] < nums[j]? Scan right to left with a decreasing stack. Values popped by a bigger x become the best "2"; any later x below that "2" is the "1". [3,1,4,2] → true. [1,2,3,4] → false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'monotonic-stack', 'arrays', 'step-by-step'],
    'related_guide' => '132-pattern',
];
