<?php
declare(strict_types=1);

return [
    'title' => 'Alphabet Board Path: mind the z',
    'leetcode' => 1138,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each letter compute its (row, col) = divmod(index, 5), move up and left before down and right, then add !. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'alphabet-board-path',
    'tags' => ['strings', 'hash-table', 'step-by-step'],
];
