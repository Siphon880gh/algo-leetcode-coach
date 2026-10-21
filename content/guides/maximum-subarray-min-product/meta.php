<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray Min-Product: monotonic stack + prefix sums',
    'leetcode' => 1856,
    'difficulty' => 'Med',
    'summary' => 'For each element as the minimum, extend to the nearest smaller element on each side (monotonic stack). Its best product is value · sum of that span; prefix sums give the sum. Take the max, then mod.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'prefix-sum', 'array', 'leetcode'],
    'related_session' => 'maximum-subarray-min-product',
];
