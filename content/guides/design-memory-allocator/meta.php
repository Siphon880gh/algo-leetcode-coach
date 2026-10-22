<?php
declare(strict_types=1);

return [
    'title' => 'Design Memory Allocator: scan for the leftmost free run',
    'leetcode' => 2502,
    'difficulty' => 'Med',
    'summary' => 'Keep an array of owner ids, 0 for free. Allocate by scanning for the first run of size free cells; free by clearing every cell owned by mID and counting them.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'array', 'hash-table', 'simulation', 'leetcode'],
    'related_session' => 'design-memory-allocator',
];
