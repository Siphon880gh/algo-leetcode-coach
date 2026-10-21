<?php
declare(strict_types=1);

return [
    'title' => 'Smallest String After Operations: BFS',
    'leetcode' => 1625,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the reachable set is small, so BFS from s with both operations (add a to odd indices, rotate by b) and return the minimum seen. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Breadth-First Search',
    'topic' => 'LeetCode · Breadth-First Search',
    'related_guide' => 'lexicographically-smallest-string-after-applying-operations',
    'tags' => ['breadth-first-search', 'string', 'enumeration', 'step-by-step'],
];
