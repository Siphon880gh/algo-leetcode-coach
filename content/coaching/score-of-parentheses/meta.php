<?php
declare(strict_types=1);

return [
    'title' => 'Score of Parentheses: add 2^depth at each "()"',
    'leetcode' => 856,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: only innermost "()" pairs score, and each enclosing pair doubles them, so track depth and add 1 << depth when ")" follows "(". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'score-of-parentheses',
    'tags' => ['stack', 'strings', 'step-by-step'],
];
