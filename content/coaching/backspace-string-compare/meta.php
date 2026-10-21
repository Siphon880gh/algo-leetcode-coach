<?php
declare(strict_types=1);

return [
    'title' => 'Backspace String Compare: scan from the end',
    'leetcode' => 844,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: a "#" only erases characters before it, so scan both strings backward, counting pending backspaces, and compare the surviving letters one by one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'backspace-string-compare',
    'tags' => ['two-pointers', 'stack', 'strings', 'step-by-step'],
];
