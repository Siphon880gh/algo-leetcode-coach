<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Money Before Transactions: worst-case order',
    'leetcode' => 2412,
    'difficulty' => 'Hard',
    'summary' => 'The adversary does every losing transaction first. Total loss L = Σ max(0, cost − cashback). Then add the largest of cashback (losing) or cost (non-losing) for the transaction done last.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-money-required-before-transactions',
    'related_session' => 'minimum-money-required-before-transactions',
];
