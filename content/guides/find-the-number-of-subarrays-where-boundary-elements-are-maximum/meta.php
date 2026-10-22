<?php
declare(strict_types=1);

return [
    'title' => 'Find the Number of Subarrays Where Boundary Elements Are Maximum: monotonic stack',
    'leetcode' => 3113,
    'difficulty' => 'Hard',
    'summary' => 'Keep a stack of (value, count) with values decreasing. For each x, pop smaller values; if the top equals x, add to its count, else push (x, 1). x ends exactly count valid subarrays.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['array', 'stack', 'monotonic-stack', 'leetcode'],
    'related_session' => 'find-the-number-of-subarrays-where-boundary-elements-are-maximum',
];
