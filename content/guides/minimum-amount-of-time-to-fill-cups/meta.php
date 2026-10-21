<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Amount of Time to Fill Cups: largest pile or half the total',
    'leetcode' => 2335,
    'difficulty' => 'Easy',
    'summary' => 'Each second fills at most two cups of different types, so the answer is at least ceil(total / 2) and at least the largest amount. Pairing the two largest piles reaches that bound.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'minimum-amount-of-time-to-fill-cups',
];
