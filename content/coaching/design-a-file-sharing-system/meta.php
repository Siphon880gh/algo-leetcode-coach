<?php
declare(strict_types=1);

return [
    'title' => 'Design a File Sharing System: id heap and owner sets',
    'leetcode' => 1500,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a min-heap of freed ids plus a counter, chunk → owners, and user → chunks for cleanup. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-a-file-sharing-system',
    'tags' => ['design', 'heap', 'hash-map', 'step-by-step'],
];
