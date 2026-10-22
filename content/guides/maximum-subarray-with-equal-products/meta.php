<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray With Equal Products: every subarray with an early stop',
    'leetcode' => 3411,
    'difficulty' => 'Easy',
    'summary' => 'With n ≤ 100 and values ≤ 10, check every subarray while tracking product, gcd and lcm. lcm · gcd ≤ 2520 · 10, so once the product passes that bound no longer extension can match.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'enumeration', 'number-theory', 'sliding-window', 'leetcode'],
    'related_session' => 'maximum-subarray-with-equal-products',
];
