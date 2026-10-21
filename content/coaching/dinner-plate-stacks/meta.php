<?php
declare(strict_types=1);

return [
    'title' => 'Dinner Plate Stacks: heap of open indices',
    'leetcode' => 1172,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep a list of stacks and a min-heap of indices with room; push uses the smallest valid index, popAtStack frees an index, and pop trims empty stacks on the right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'dinner-plate-stacks',
    'tags' => ['design', 'heap', 'stack', 'step-by-step'],
];
