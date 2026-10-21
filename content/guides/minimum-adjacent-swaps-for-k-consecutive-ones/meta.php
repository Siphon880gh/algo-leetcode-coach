<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Adjacent Swaps for K Consecutive Ones: median of shifted positions',
    'leetcode' => 1703,
    'difficulty' => 'Hard',
    'summary' => 'List the positions of ones and subtract each one\'s index (q[i] = p[i] − i), which turns "gather consecutively" into "gather to one point". For each window of k, the cost is the distance sum to the window median, computed with prefix sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'prefix-sum', 'greedy', 'leetcode'],
    'related_session' => 'minimum-adjacent-swaps-for-k-consecutive-ones',
];
