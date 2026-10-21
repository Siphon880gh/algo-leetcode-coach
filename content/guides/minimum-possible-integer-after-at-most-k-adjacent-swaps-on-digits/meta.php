<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Possible Integer After at Most K Adjacent Swaps: greedy with a Fenwick tree',
    'leetcode' => 1505,
    'difficulty' => 'Hard',
    'summary' => 'Greedily pick the smallest digit within reach (its current position ≤ k) and bubble it to the front. Track original positions per digit and a BIT of removed indices to get current positions fast.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'fenwick-tree', 'strings', 'leetcode'],
    'related_session' => 'minimum-possible-integer-after-at-most-k-adjacent-swaps-on-digits',
];
