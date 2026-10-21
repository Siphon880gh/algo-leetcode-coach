<?php
declare(strict_types=1);

return [
    'title' => '132 Pattern: scan right to left with a decreasing stack and the best "2"',
    'leetcode' => 456,
    'difficulty' => 'Med',
    'summary' => 'Is there i < j < k with nums[i] < nums[k] < nums[j]? Scan from the right with a stack kept decreasing. When x is bigger than the top, pop — the largest popped value is the best "2" (nums[k]) that has a bigger "3" to its left. If any later x (further left) is below that "2", return true. [3,1,4,2] → true. [1,2,3,4] → false.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'monotonic-stack', 'arrays', 'leetcode'],
    'related_session' => '132-pattern',
];
