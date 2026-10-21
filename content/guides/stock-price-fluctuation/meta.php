<?php
declare(strict_types=1);

return [
    'title' => 'Stock Price Fluctuation: map plus lazy heaps',
    'leetcode' => 2034,
    'difficulty' => 'Med',
    'summary' => 'Keep timestamp → price in a hash map and the latest timestamp. For max and min, push (price, timestamp) into two heaps and lazily pop entries whose price no longer matches the map.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'heap', 'hash-table', 'leetcode'],
    'related_session' => 'stock-price-fluctuation',
];
