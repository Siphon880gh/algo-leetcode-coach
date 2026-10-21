<?php
declare(strict_types=1);

return [
    'title' => 'Products With Three or More Orders in Two Consecutive Years: yearly counts, then a self-join',
    'leetcode' => 2292,
    'difficulty' => 'Med',
    'summary' => 'Group by product and year, keep the groups with at least three orders, then join that result to itself on the same product and the next year and return the distinct product ids.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'products-with-three-or-more-orders-in-two-consecutive-years',
];
