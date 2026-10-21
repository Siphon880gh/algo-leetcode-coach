<?php
declare(strict_types=1);

return [
    'title' => 'Insert into a Sorted Circular Linked List: find the right gap or the wrap',
    'leetcode' => 708,
    'difficulty' => 'Med',
    'summary' => 'Walk the circle once looking at pairs (prev, cur). Insert between them when prev ≤ x ≤ cur, or at the wrap (prev > cur) when x is a new max or min. If a full loop finds neither, every value is equal, so insert anywhere.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'kind' => 'algo',
    'tags' => ['linked-list', 'leetcode'],
    'related_session' => 'insert-into-a-sorted-circular-linked-list',
];
