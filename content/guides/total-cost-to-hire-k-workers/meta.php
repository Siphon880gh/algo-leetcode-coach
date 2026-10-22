<?php
declare(strict_types=1);

return [
    'title' => 'Total Cost to Hire K Workers: one heap over both ends',
    'leetcode' => 2462,
    'difficulty' => 'Med',
    'summary' => 'Keep the first and last candidates workers in one min-heap ordered by cost, then index. After each hire, refill from the side it came from while the untouched middle lasts.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'heap', 'simulation', 'leetcode'],
    'related_session' => 'total-cost-to-hire-k-workers',
];
