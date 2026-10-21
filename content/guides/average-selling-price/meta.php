<?php
declare(strict_types=1);

return [
    'title' => 'Average Selling Price: join sales to the matching price period',
    'leetcode' => 1251,
    'difficulty' => 'Easy',
    'summary' => 'Left join each product\'s price periods to sales whose purchase date falls inside the period. The average is SUM(price · units) / SUM(units), rounded to 2 decimals, with 0 when nothing sold.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'average-selling-price',
];
