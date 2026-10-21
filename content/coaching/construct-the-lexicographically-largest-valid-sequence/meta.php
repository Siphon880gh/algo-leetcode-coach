<?php
declare(strict_types=1);

return [
    'title' => 'Construct the Lexicographically Largest Valid Sequence: backtracking from big to small',
    'leetcode' => 1718,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: fill the first empty slot, trying numbers n down to 1; i ≥ 2 also occupies slot + i. The first complete fill is the answer. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'construct-the-lexicographically-largest-valid-sequence',
    'tags' => ['backtracking', 'array', 'step-by-step'],
];
