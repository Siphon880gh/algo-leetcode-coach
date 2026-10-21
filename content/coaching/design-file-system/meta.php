<?php
declare(strict_types=1);

return [
    'title' => 'Design File System: parent must exist',
    'leetcode' => 1166,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: store full paths in a map, reject existing paths, take the parent as the text before the last slash, and require it to be empty or stored. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-file-system',
    'tags' => ['design', 'hash-table', 'strings', 'step-by-step'],
];
