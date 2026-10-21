<?php
declare(strict_types=1);

return [
    'title' => 'Balanced String Deletions: delete this a or every earlier b',
    'leetcode' => 1653,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count b\'s seen; at each a, res = min(res + 1, bCount). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-deletions-to-make-string-balanced',
    'tags' => ['dynamic-programming', 'string', 'stack', 'step-by-step'],
];
