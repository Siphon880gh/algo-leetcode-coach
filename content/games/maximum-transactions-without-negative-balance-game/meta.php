<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Transactions Without Negative Balance',
    'leetcode' => 3711,
    'difficulty' => 'Med',
    'summary' => 'Take every transaction greedily, pushing negatives into a min-heap. If the balance drops below 0, undo the most negative taken payment (the heap top). Each undo costs one transaction but restores the most money.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-transactions-without-negative-balance',
    'related_session' => 'maximum-transactions-without-negative-balance',
];
