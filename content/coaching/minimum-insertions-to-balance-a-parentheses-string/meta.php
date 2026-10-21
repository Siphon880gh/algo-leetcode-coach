<?php
declare(strict_types=1);

return [
    'title' => 'Min Insertions to Balance Parentheses: need counter',
    'leetcode' => 1541,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: ( adds 2 to need (insert a ) first if need is odd); ) subtracts 1 (insert a ( if need goes negative); answer = inserts + need. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'minimum-insertions-to-balance-a-parentheses-string',
    'tags' => ['stack', 'greedy', 'strings', 'step-by-step'],
];
