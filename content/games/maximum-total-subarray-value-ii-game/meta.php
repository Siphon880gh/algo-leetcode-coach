<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Subarray Value II',
    'leetcode' => 3691,
    'difficulty' => 'Hard',
    'summary' => 'For a fixed l, max − min of nums[l to r] only shrinks as r shrinks. Push (l, n−1) for every l into a max-heap (range max or min from a sparse table); pop the best k times, each time pushing (l, r−1).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-total-subarray-value-ii',
    'related_session' => 'maximum-total-subarray-value-ii',
];
