<?php
declare(strict_types=1);

return [
    'title' => 'Find Pivot Index: left sum vs. total − left − nums[i]',
    'leetcode' => 724,
    'difficulty' => 'Easy',
    'summary' => 'Compute total once. Walk with leftSum. At i, the right side is total − leftSum − nums[i]. If the two match, i is the pivot; otherwise add nums[i] to leftSum and move on.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-pivot-index',
    'related_session' => 'find-pivot-index',
];
