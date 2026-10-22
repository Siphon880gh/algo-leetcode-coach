<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Columns Strictly Increasing: raise each cell just enough',
    'leetcode' => 3402,
    'difficulty' => 'Easy',
    'summary' => 'Go down each column keeping the previous value after raising. A cell must become at least previous + 1; raising it any further only costs more and makes the next cells harder.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'matrix', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-columns-strictly-increasing',
];
