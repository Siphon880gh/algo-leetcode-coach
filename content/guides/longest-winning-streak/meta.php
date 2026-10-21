<?php
declare(strict_types=1);

return [
    'title' => 'Longest Winning Streak: group runs with row-number difference',
    'leetcode' => 2173,
    'difficulty' => 'Hard',
    'summary' => 'Number each player’s matches by day, and separately number them within each result. The difference is constant along a run of equal results, so group wins by it, count, and take the max; a LEFT JOIN from players gives 0 for no wins.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'longest-winning-streak',
];
