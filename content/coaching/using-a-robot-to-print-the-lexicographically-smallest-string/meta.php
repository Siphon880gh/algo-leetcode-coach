<?php
declare(strict_types=1);

return [
    'title' => 'Using a Robot to Print the Lexicographically Smallest String: pop on ≤, empty t at the end',
    'leetcode' => 2434,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pop while the top is at most the smallest letter still in s, and empty t once s runs out. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'using-a-robot-to-print-the-lexicographically-smallest-string',
    'tags' => ['hash-table', 'string', 'stack', 'greedy', 'step-by-step'],
];
