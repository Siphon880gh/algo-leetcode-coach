<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subarrays With LCM Equal to K: extend each start, stop when k is not a multiple',
    'leetcode' => 2470,
    'difficulty' => 'Med',
    'summary' => 'For every start, extend right keeping the running LCM, counting ends where it equals k. Stop once the LCM no longer divides k, since it can only grow from there.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'number-of-subarrays-with-lcm-equal-to-k',
];
