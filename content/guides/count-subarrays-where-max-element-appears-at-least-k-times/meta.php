<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays Where Max Element Appears at Least K Times: k-th last position',
    'leetcode' => 2962,
    'difficulty' => 'Med',
    'summary' => 'Record the positions of the maximum. For each right end r with at least k of them, every start up to the k-th last position works, so add that position + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'sliding-window', 'leetcode'],
    'related_session' => 'count-subarrays-where-max-element-appears-at-least-k-times',
];
