<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Common Supersequence: walk back the LCS table',
    'leetcode' => 1092,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fill the LCS table, then walk back from the end, emitting a shared letter once and otherwise the letter from the side with the larger LCS value. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'shortest-common-supersequence',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];
