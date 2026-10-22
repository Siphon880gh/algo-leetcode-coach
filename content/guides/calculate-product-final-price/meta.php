<?php
declare(strict_types=1);

return [
    'title' => 'Calculate Product Final Price: left join the discount',
    'leetcode' => 3293,
    'difficulty' => 'Med',
    'summary' => 'LEFT JOIN products to discounts on category and apply COALESCE(discount, 0), so products without a discount keep their price.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'calculate-product-final-price',
];
