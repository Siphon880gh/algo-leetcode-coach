<?php
declare(strict_types=1);

return [
    'title' => 'Stock Price Fluctuation',
    'leetcode' => 2034,
    'difficulty' => 'Med',
    'summary' => 'Map timestamp to price (updates overwrite) and track the latest timestamp. maximum or minimum come from a heap with lazy deletion of stale (price, time) entries, or a sorted multiset of prices.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stock-price-fluctuation',
    'related_session' => 'stock-price-fluctuation',
];
