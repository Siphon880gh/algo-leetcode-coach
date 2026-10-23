<?php
declare(strict_types=1);

return [
    'title' => 'Best Time to Buy and Sell Stock V: three holding states',
    'leetcode' => 3573,
    'difficulty' => 'Med',
    'summary' => 'Per number of completed transactions keep three values: free, holding a long position, holding a short. Each day, open from free or close from a holding state; using the previous day’s values means a close and the next open never share a day.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'best-time-to-buy-and-sell-stock-v',
];
