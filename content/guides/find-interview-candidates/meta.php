<?php
declare(strict_types=1);

return [
    'title' => 'Find Interview Candidates: medals in a row or three golds',
    'leetcode' => 1811,
    'difficulty' => 'Med',
    'summary' => 'Unpivot medals into (contest, user) rows. Consecutive: self-join the medal rows on contest + 1 and + 2. Gold: group the gold column and keep counts ≥ 3. Union the two sets and join to users.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'self-join', 'union', 'leetcode'],
    'related_session' => 'find-interview-candidates',
];
