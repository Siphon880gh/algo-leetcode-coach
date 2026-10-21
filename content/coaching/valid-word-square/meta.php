<?php
declare(strict_types=1);

return [
    'title' => 'Valid Word Square: k-th row equals k-th column, including jagged',
    'leetcode' => 422,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: true iff the k-th row reads the same as the k-th column. Rows may have different lengths. For every words[i][j], row j must exist, be long enough, and have words[j][i] equal. ["abcd","bnrt","crm","dt"] → true. ["ball","area","read","lady"] → false. Not 425. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'tags' => ['matrix', 'strings', 'step-by-step'],
    'related_guide' => 'valid-word-square',
];
