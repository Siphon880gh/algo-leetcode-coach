<?php
declare(strict_types=1);

return [
    'title' => 'Product of the Last K Numbers: prefix products reset at zero',
    'leetcode' => 1352,
    'difficulty' => 'Med',
    'summary' => 'Keep prefix products since the last zero. The product of the last k numbers is p[last] / p[last − k], unless k reaches back past the last zero, in which case it is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'prefix-sum', 'leetcode'],
    'related_session' => 'product-of-the-last-k-numbers',
];
