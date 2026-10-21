<?php
declare(strict_types=1);

return [
    'title' => 'Count All Valid Pickup and Delivery Options: insert the i-th pair',
    'leetcode' => 1359,
    'difficulty' => 'Hard',
    'summary' => 'Build orderings by adding one order at a time. With 2(i − 1) items placed, there are 2i − 1 gaps; choosing two gaps for pickup before delivery gives i · (2i − 1) ways, so the answer is the product of i · (2i − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'leetcode'],
    'related_session' => 'count-all-valid-pickup-and-delivery-options',
];
