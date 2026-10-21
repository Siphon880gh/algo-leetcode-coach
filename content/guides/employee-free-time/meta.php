<?php
declare(strict_types=1);

return [
    'title' => 'Employee Free Time: merge everyone\'s busy intervals',
    'leetcode' => 759,
    'difficulty' => 'Hard',
    'summary' => 'Everyone is free exactly where nobody is busy. Collect all intervals, sort by start (or k-way merge them with a heap), and walk them tracking the latest end; every gap between that end and the next start is common free time.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'kind' => 'algo',
    'tags' => ['intervals', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'employee-free-time',
];
