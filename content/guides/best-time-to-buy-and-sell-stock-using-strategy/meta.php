<?php
declare(strict_types=1);

return [
    'title' => 'Best Time to Buy and Sell Stock using Strategy: best window by prefix sums',
    'leetcode' => 3652,
    'difficulty' => 'Med',
    'summary' => 'Changing window [i, i + k) to holds then sells changes the profit by (sum of prices in its second half) − (Σ strategy · price in the window). Use prefix sums for both and keep the best gain, or 0 for no change.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'best-time-to-buy-and-sell-stock-using-strategy',
];
