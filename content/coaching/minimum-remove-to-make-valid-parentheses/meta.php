<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Remove to Make Valid Parentheses: mark unmatched',
    'leetcode' => 1249,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: push indices of "(", match each ")" or mark it, mark leftover "(", and rebuild without marked indices. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'minimum-remove-to-make-valid-parentheses',
    'tags' => ['stack', 'strings', 'step-by-step'],
];
