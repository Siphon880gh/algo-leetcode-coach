<?php
declare(strict_types=1);

return [
    'title' => 'Design a File Sharing System: id pool + chunk owner sets',
    'leetcode' => 1500,
    'difficulty' => 'Med',
    'summary' => 'Keep a min-heap of freed ids plus a counter for new ones, a map chunk → owner set, and per-user chunk sets so leaving can clean up.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'heap', 'hash-map', 'leetcode'],
    'related_session' => 'design-a-file-sharing-system',
];
