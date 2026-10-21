<?php
declare(strict_types=1);

return [
    'title' => 'Elements in Array After Removing and Replacing Elements: period 2n',
    'leetcode' => 2113,
    'difficulty' => 'Med',
    'summary' => 'The state repeats every 2n minutes. With t = time mod 2n: for t < n the array is nums[t …], so index j holds nums[t + j] if j < n − t; otherwise it is nums[0 … t − n − 1], so j holds nums[j] if j < t − n.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'simulation', 'leetcode'],
    'related_session' => 'elements-in-array-after-removing-and-replacing-elements',
];
