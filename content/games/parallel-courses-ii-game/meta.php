<?php
declare(strict_types=1);

return [
    'title' => 'Parallel Courses II (bitmask DP)',
    'leetcode' => 1494,
    'difficulty' => 'Hard',
    'summary' => 'dp[mask] = fewest semesters to finish the courses in mask. From mask, the available courses have all prerequisites in mask; take all if ≤ k, otherwise try every subset of exactly k.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'parallel-courses-ii',
    'related_session' => 'parallel-courses-ii',
];
