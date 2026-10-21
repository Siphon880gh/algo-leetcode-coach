<?php
declare(strict_types=1);

return [
    'title' => 'Apply Discount Every n Orders: count and look up prices',
    'leetcode' => 1357,
    'difficulty' => 'Med',
    'summary' => 'Map product ids to prices once. On each getBill, count the call; total the bill from the map, and apply the percentage discount on every n-th customer.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-map', 'leetcode'],
    'related_session' => 'apply-discount-every-n-orders',
];
