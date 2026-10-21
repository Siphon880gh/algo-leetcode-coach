<?php
declare(strict_types=1);

return [
    'title' => 'Accounts Merge: link through emails',
    'leetcode' => 721,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: union every email with its account\'s first email, group by root, sort, and attach the name. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'accounts-merge',
    'tags' => ['union-find', 'graphs', 'dfs', 'hash-map', 'sorting', 'step-by-step'],
];
