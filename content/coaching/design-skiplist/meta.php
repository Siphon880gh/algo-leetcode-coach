<?php
declare(strict_types=1);

return [
    'title' => 'Design Skiplist: search paths and update arrays',
    'leetcode' => 1206,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: from the top level move right while the next value is smaller, record a predecessor per level, then use those predecessors for search, add, and erase. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-skiplist',
    'tags' => ['design', 'linked-list', 'randomized', 'step-by-step'],
];
