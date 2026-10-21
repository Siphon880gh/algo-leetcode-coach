<?php
declare(strict_types=1);

return [
    'title' => 'Find Pivot Index: left sum against what remains',
    'leetcode' => 724,
    'difficulty' => 'Easy',
    'summary' => 'Compute the total once. Scan left to right with a running left sum; index i is a pivot when left == total − left − nums[i]. Return the first one, or -1.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'arrays', 'leetcode'],
    'related_session' => 'find-pivot-index',
];
