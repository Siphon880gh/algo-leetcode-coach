<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Integer After k Adjacent Swaps: pull the smallest reachable digit',
    'leetcode' => 1505,
    'difficulty' => 'Hard',
    'summary' => 'For each position, find the smallest digit within the next k positions (first occurrence) and bubble it forward, spending its distance from k. A Fenwick tree tracks shifted positions in O(n log n).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-possible-integer-after-at-most-k-adjacent-swaps-on-digits',
    'related_session' => 'minimum-possible-integer-after-at-most-k-adjacent-swaps-on-digits',
];
