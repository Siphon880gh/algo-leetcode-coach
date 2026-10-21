<?php
declare(strict_types=1);

return [
    'title' => 'String Compression: read pointer, write pointer, write the count digit by digit',
    'leetcode' => 443,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: compress runs in place as char then count (count only if > 1, one char per digit). Read pointer finds the run end; write pointer copies the char and the count digits. ["a","a","b","b","c","c","c"] → 6 (a2b2c3). Twelve b’s write "b","1","2". Not 38. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'strings', 'step-by-step'],
    'related_guide' => 'string-compression',
];
