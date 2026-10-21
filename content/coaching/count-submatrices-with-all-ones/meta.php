<?php
declare(strict_types=1);

return [
    'title' => 'Count Submatrices With All Ones: heights per row',
    'leetcode' => 1504,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: maintain column heights of consecutive 1s; for each bottom-right cell walk left with a running min height and add it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'related_guide' => 'count-submatrices-with-all-ones',
    'tags' => ['matrix', 'monotonic-stack', 'dp', 'step-by-step'],
];
