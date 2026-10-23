<?php
declare(strict_types=1);

return [
    'title' => 'Stock III: four states, buy1 → sell1 → buy2 → sell2',
    'leetcode' => 123,
    'difficulty' => 'Hard',
    'summary' => 'Track the best cash after each state: buy1 = max(buy1, −p), sell1 = max(sell1, buy1 + p), buy2 = max(buy2, sell1 − p), sell2 = max(sell2, buy2 + p).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'best-time-to-buy-and-sell-stock-iii',
    'related_session' => 'best-time-to-buy-and-sell-stock-iii',
];
