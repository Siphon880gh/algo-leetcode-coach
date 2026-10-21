<?php
declare(strict_types=1);

return [
    'title' => 'Iterator for Combination: precompute in order',
    'leetcode' => 1286,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: backtrack over the characters choosing increasing positions to generate every combination in lexicographic order once, then serve next and hasNext from an index. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'iterator-for-combination',
    'tags' => ['backtracking', 'design', 'step-by-step'],
];
