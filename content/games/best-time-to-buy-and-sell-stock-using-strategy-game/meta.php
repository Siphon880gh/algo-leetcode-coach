<?php
declare(strict_types=1);

return [
    'title' => 'Best Time to Buy and Sell Stock using Strategy',
    'leetcode' => 3652,
    'difficulty' => 'Med',
    'summary' => 'Base profit = the sum of strategy[i] times prices[i]. Changing window [i, i+k) removes its old contribution and adds the prices of its second half. Slide the window with prefix sums and add the best non-negative gain.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'best-time-to-buy-and-sell-stock-using-strategy',
    'related_session' => 'best-time-to-buy-and-sell-stock-using-strategy',
];
