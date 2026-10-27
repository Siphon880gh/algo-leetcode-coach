<?php
declare(strict_types=1);

return [
    'title' => 'The Most Similar Path in a Graph',
    'leetcode' => 1548,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][v] = min edit cost of a path matching targetPath[0 to i] ending at city v = (name mismatch) + min dp[i − 1][u] over neighbors u. Reconstruct with parent pointers.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'the-most-similar-path-in-a-graph',
    'related_session' => 'the-most-similar-path-in-a-graph',
];
