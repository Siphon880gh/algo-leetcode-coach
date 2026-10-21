<?php
declare(strict_types=1);

return [
    'title' => 'Numbers With Same Consecutive Differences: grow by ±k',
    'leetcode' => 967,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: start with digits 1 to 9 and extend each number by last ± k within 0 to 9, taking care not to add the same digit twice when k = 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'numbers-with-same-consecutive-differences',
    'tags' => ['backtracking', 'bfs', 'step-by-step'],
];
