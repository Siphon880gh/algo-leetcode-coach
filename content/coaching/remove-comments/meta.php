<?php
declare(strict_types=1);

return [
    'title' => 'Remove Comments: block mode survives line breaks',
    'leetcode' => 722,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: scan characters with an in-block flag, skip two characters on each comment marker, and keep the buffer across lines inside a block. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'remove-comments',
    'tags' => ['strings', 'simulation', 'parsing', 'step-by-step'],
];
