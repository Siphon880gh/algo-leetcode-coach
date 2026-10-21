<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence Repeated k Times: BFS over candidates',
    'leetcode' => 2014,
    'difficulty' => 'Hard',
    'summary' => 'A repeated subsequence uses only characters appearing at least k times, and its length is at most n / k < 8. BFS candidates by length, extending with those characters, keeping only ones where seq * k is a subsequence; the last level, tried in descending character order, gives the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'bfs', 'string', 'greedy', 'leetcode'],
    'related_session' => 'longest-subsequence-repeated-k-times',
];
