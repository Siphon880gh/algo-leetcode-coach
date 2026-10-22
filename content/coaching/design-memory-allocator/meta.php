<?php
declare(strict_types=1);

return [
    'title' => 'Design Memory Allocator: reset the run on a used cell, free every block',
    'leetcode' => 2502,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: restart the free-run count at any used cell, and free every cell of mID, not only its latest block. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-memory-allocator',
    'tags' => ['design', 'array', 'hash-table', 'simulation', 'step-by-step'],
];
