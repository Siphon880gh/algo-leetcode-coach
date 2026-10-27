<?php
declare(strict_types=1);

return [
    'title' => 'Word Search: DFS, mark visited, unmark on the way back',
    'leetcode' => 79,
    'difficulty' => 'Med',
    'summary' => 'Scan cells row by row for the first letter. From a match, step to an adjacent (up, down, left or right) unvisited cell holding the next letter. If none matches, unmark and backtrack to keep scanning.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'word-search',
    'related_session' => 'word-search',
];
