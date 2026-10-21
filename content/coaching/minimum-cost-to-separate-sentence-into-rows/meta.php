<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Separate Sentence Into Rows: DP over row ends',
    'leetcode' => 2052,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: try every end for the row starting at word i, last row free, memoise. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-cost-to-separate-sentence-into-rows',
    'tags' => ['dynamic-programming', 'string', 'step-by-step'],
];
