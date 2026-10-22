<?php
declare(strict_types=1);

return [
    'title' => 'Course Schedule: take what has no prerequisites left',
    'leetcode' => 207,
    'difficulty' => 'Med',
    'summary' => 'Kahn\'s algorithm: repeatedly take every course whose in-degree is 0 and remove its outgoing edges. If some courses never reach in-degree 0, they are in a cycle.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'course-schedule',
    'related_session' => 'course-schedule',
];
