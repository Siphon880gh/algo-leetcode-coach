<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Width Ramp: decreasing stack of starts, scan ends from the right',
    'leetcode' => 962,
    'difficulty' => 'Med',
    'summary' => 'Only prefix minima can be the best start. Push indices whose value is lower than every earlier one onto a stack, then scan j from the right, popping every start with nums[start] ≤ nums[j] and recording j − start.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'arrays', 'two-pointers', 'leetcode'],
    'related_session' => 'maximum-width-ramp',
];
