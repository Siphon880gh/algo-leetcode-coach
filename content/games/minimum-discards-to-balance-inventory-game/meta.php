<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Discards to Balance Inventory',
    'leetcode' => 3679,
    'difficulty' => 'Med',
    'summary' => 'Greedy simulation: keep a count of kept items per type in the last w days. On day i, first forget the kept arrival from day i − w; then keep the new item unless its type already has m kept in the window.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-discards-to-balance-inventory',
    'related_session' => 'minimum-discards-to-balance-inventory',
];
