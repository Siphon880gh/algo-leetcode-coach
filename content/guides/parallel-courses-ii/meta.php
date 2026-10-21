<?php
declare(strict_types=1);

return [
    'title' => 'Parallel Courses II: bitmask DP over taken courses',
    'leetcode' => 1494,
    'difficulty' => 'Hard',
    'summary' => 'n ≤ 15, so the state is the set of taken courses. Available = courses whose prerequisites are all taken. If at most k are available take them all; otherwise try every k-subset.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'bitmask', 'graph', 'leetcode'],
    'related_session' => 'parallel-courses-ii',
];
