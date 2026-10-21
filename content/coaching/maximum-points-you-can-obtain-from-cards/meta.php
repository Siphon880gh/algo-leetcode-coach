<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points You Can Obtain from Cards: k from the ends',
    'leetcode' => 1423,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: take the first k cards, then swap one left card for one right card at a time, k times, tracking the max. Equivalently, drop the minimum window of n − k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'maximum-points-you-can-obtain-from-cards',
    'tags' => ['sliding-window', 'prefix-sum', 'step-by-step'],
];
