<?php
declare(strict_types=1);

return [
    'title' => 'Longest Uploaded Prefix: a pointer that only moves forward',
    'leetcode' => 2424,
    'difficulty' => 'Med',
    'summary' => 'Mark uploaded videos in an array and keep a pointer to the current prefix length. On each query, advance it while the next video is uploaded; it never moves back, so the total work is O(n).',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'union-find', 'binary-indexed-tree', 'segment-tree', 'leetcode'],
    'related_session' => 'longest-uploaded-prefix',
];
