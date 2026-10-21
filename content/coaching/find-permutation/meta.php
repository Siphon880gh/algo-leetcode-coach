<?php
declare(strict_types=1);

return [
    'title' => 'Find Permutation: start from 1..n+1, reverse every D run',
    'leetcode' => 484,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: smallest permutation of 1..n + 1 matching an I/D string. Start ascending, then reverse each block covering a run of D plus the element after it. "DI" → [2,1,3]. "IDDI" → [1,4,3,2,5]. Not 942. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'stack', 'arrays', 'step-by-step'],
    'related_guide' => 'find-permutation',
];
