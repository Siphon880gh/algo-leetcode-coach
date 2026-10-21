<?php
declare(strict_types=1);

return [
    'title' => 'Count Submatrices With All Ones: histogram heights per row',
    'leetcode' => 1504,
    'difficulty' => 'Med',
    'summary' => 'Keep h[j] = consecutive 1s ending at the current row in column j. For each cell as the bottom-right corner, walk left taking the running min height and add it; a monotonic stack makes that O(C) per row.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['matrix', 'monotonic-stack', 'dp', 'leetcode'],
    'related_session' => 'count-submatrices-with-all-ones',
];
