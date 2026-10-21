<?php
declare(strict_types=1);

return [
    'title' => 'Dinner Plate Stacks: min-heap of open stacks',
    'leetcode' => 1172,
    'difficulty' => 'Hard',
    'summary' => 'Keep a list of stacks plus a min-heap of indices of stacks that are not full. push uses the smallest valid index from the heap or appends a stack; pop trims empty stacks from the right end.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'heap', 'stack', 'leetcode'],
    'related_session' => 'dinner-plate-stacks',
];
