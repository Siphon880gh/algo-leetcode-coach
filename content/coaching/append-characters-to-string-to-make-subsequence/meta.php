<?php
declare(strict_types=1);

return [
    'title' => 'Append Characters to String to Make Subsequence: never reset, order matters',
    'leetcode' => 2486,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the matched prefix of t when letters differ, and count what is left of t in order, not as a multiset. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'append-characters-to-string-to-make-subsequence',
    'tags' => ['two-pointers', 'string', 'greedy', 'step-by-step'],
];
