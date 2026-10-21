<?php
declare(strict_types=1);

return [
    'title' => 'Product\'s Price for Each Store: pivot with conditional aggregation',
    'leetcode' => 1777,
    'difficulty' => 'Easy',
    'summary' => 'GROUP BY product and, for each store, take MAX(CASE WHEN store = that store THEN price END); missing stores give NULL.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'pivot', 'leetcode'],
    'related_session' => 'products-price-for-each-store',
];
