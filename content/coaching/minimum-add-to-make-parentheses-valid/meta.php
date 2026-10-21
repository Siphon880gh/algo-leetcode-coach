<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Add to Make Parentheses Valid: balance and extras',
    'leetcode' => 921,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the number of open brackets; an unmatched ")" needs an added "(", and whatever is still open at the end needs a ")". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'minimum-add-to-make-parentheses-valid',
    'tags' => ['stack', 'greedy', 'strings', 'step-by-step'],
];
