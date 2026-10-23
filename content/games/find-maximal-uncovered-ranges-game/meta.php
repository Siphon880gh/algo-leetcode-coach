<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximal Uncovered Ranges',
    'leetcode' => 2655,
    'difficulty' => 'Med',
    'summary' => 'Sort ranges by start; sweep a "covered up to" pointer and emit every gap [pointer + 1, start − 1], plus the tail up to n − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'tags' => ['sorting', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-maximal-uncovered-ranges',
    'related_session' => 'find-maximal-uncovered-ranges',
];
