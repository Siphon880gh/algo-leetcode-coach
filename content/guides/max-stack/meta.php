<?php
declare(strict_types=1);

return [
    'title' => 'Max Stack: a linked list plus a sorted map of values',
    'leetcode' => 716,
    'difficulty' => 'Hard',
    'summary' => 'Keep the stack as a doubly linked list so any node can be unlinked in O(1), and a sorted map from value to the list of its nodes in push order. popMax takes the newest node of the largest value; everything is O(log n).',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'stack', 'linked-list', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'max-stack',
];
