<?php
declare(strict_types=1);

return [
    'title' => 'Non-decreasing Subsequences: backtrack, skip repeated choices at each depth',
    'leetcode' => 491,
    'difficulty' => 'Med',
    'summary' => 'All distinct non-decreasing subsequences of length ≥ 2. Backtrack: at each depth, try each later index whose value is at least the last one, but use each value only once per depth (a small set) so duplicates never form. Record the path when it has two or more values. [4,6,7,7] → 8 lists. [4,4,3,2,1] → [[4,4]]. Not 300 / 90.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'non-decreasing-subsequences',
];
