<?php
declare(strict_types=1);

return [
    'title' => 'Find Valid Matrix Given Row and Column Sums',
    'leetcode' => 1605,
    'difficulty' => 'Med',
    'summary' => 'Greedy: set cell (i, j) to min(rowSum[i], colSum[j]) and subtract it from both. Two pointers move on whichever sum hits 0 first.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-valid-matrix-given-row-and-column-sums',
    'related_session' => 'find-valid-matrix-given-row-and-column-sums',
];
