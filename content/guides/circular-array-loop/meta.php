<?php
declare(strict_types=1);

return [
    'title' => 'Circular Array Loop: fast and slow pointers, one direction, length more than 1',
    'leetcode' => 457,
    'difficulty' => 'Med',
    'summary' => 'From index i you jump nums[i] steps around the circle. Is there a cycle of length > 1 whose values all share one sign? From each start run slow and fast pointers while the sign stays the same; if they meet and the node does not point to itself, true. Zero out dead paths so the total work is O(n). [2,−1,1,2,2] → true.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'arrays', 'cycle-detection', 'leetcode'],
    'related_session' => 'circular-array-loop',
];
