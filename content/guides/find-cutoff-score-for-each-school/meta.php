<?php
declare(strict_types=1);

return [
    'title' => 'Find Cutoff Score for Each School: smallest score within capacity',
    'leetcode' => 1988,
    'difficulty' => 'Med',
    'summary' => 'For each school, take MIN(score) over exam rows with student_count ≤ capacity via a correlated subquery or a left join with grouping, and turn NULL into −1.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'joins', 'leetcode'],
    'related_session' => 'find-cutoff-score-for-each-school',
];
