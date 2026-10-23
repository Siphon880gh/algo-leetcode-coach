<?php
declare(strict_types=1);

return [
    'title' => 'Find the String with LCP',
    'leetcode' => 2573,
    'difficulty' => 'Hard',
    'summary' => 'Greedy: give position i a new letter if unassigned, and copy it to every j with lcp[i][j] > 0 (those must be equal). Then rebuild the LCP matrix from the string (from the bottom-right) and verify it matches.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-string-with-lcp',
    'related_session' => 'find-the-string-with-lcp',
];
