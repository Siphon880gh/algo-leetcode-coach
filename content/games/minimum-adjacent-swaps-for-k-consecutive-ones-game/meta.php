<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Adjacent Swaps for K Consecutive Ones',
    'leetcode' => 1703,
    'difficulty' => 'Hard',
    'summary' => 'Take positions p of the ones and set q[i] = p[i] − i (gathering becomes "make q equal"). For each window of k consecutive q values, the cost is Σ|q − median|; slide with prefix sums and take the minimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-adjacent-swaps-for-k-consecutive-ones',
    'related_session' => 'minimum-adjacent-swaps-for-k-consecutive-ones',
];
