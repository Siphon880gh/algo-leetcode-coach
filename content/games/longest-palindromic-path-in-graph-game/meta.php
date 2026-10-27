<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Path in Graph',
    'leetcode' => 3615,
    'difficulty' => 'Hard',
    'summary' => 'Grow palindromes from the middle: start from a node (odd length) or an edge with equal labels (even length), then extend both ends at once to unvisited neighbors with matching labels. A bitmask DP over (visited set, left end, right end) memoizes this.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-palindromic-path-in-graph',
    'related_session' => 'longest-palindromic-path-in-graph',
];
