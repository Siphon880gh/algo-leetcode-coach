<?php
declare(strict_types=1);

return [
    'title' => 'Longest Fibonacci Subarray: extend runs',
    'leetcode' => 3708,
    'difficulty' => 'Med',
    'summary' => 'Scan from index 2. Extend the current run when nums[i] = nums[i − 1] + nums[i − 2]; otherwise restart it at length 2, since the last two elements always form one.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'longest-fibonacci-subarray',
];
