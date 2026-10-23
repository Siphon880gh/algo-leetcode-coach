<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Value of Covered Indices: DP on whether the last token stayed',
    'leetcode' => 3952,
    'difficulty' => 'Med',
    'summary' => 'Each token stays or moves one left. Scan left to right with one flag: did the previous token stay? Staying adds nums[i]; moving adds nums[i − 1] unless that index is already covered.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-total-value-of-covered-indices',
];
