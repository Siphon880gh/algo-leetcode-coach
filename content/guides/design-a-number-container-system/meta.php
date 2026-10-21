<?php
declare(strict_types=1);

return [
    'title' => 'Design a Number Container System: heaps with lazy deletion',
    'leetcode' => 2349,
    'difficulty' => 'Med',
    'summary' => 'Keep index → number in a map and, for each number, a min-heap of indices. change pushes the index; find pops heap tops whose index no longer holds that number, then returns the top or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'design-a-number-container-system',
];
