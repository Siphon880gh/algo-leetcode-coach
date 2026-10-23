<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Items From Sale II: cheap doubles, then singles',
    'leetcode' => 3947,
    'difficulty' => 'Med',
    'summary' => 'A copy of item i that earns a free item is worth 2 for price_i, and type i has d_i such copies. Any other copy is worth 1, cheapest at the minimum price. The total value is concave in how many doubles you buy, so take doubles from the cheapest up while they cost at most twice the minimum price.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'maximum-number-of-items-from-sale-ii',
];
