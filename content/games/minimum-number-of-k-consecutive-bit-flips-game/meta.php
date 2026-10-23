<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of K Consecutive Bit Flips',
    'leetcode' => 995,
    'difficulty' => 'Hard',
    'summary' => 'Greedy left to right: the current bit\'s value is nums[i] XOR (number of active flips covering i) mod 2. If it is 0, start a flip at i (impossible if i + k > n). Track when flips expire.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-k-consecutive-bit-flips',
    'related_session' => 'minimum-number-of-k-consecutive-bit-flips',
];
