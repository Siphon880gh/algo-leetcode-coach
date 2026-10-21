<?php
declare(strict_types=1);

return [
    'title' => 'All Possible Full Binary Trees: memoize by size',
    'leetcode' => 894,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: full trees have odd sizes, so for each odd left size combine every left tree with every right tree, caching the list for each n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'related_guide' => 'all-possible-full-binary-trees',
    'tags' => ['recursion', 'memoization', 'trees', 'dynamic-programming', 'step-by-step'],
];
