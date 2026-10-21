<?php
declare(strict_types=1);

return [
    'title' => 'Find Interview Candidates: medals in a row or three golds',
    'leetcode' => 1811,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: unpivot medals to (contest, user), self-join on contest + 1 and + 2 for streaks, group golds for counts ≥ 3, and report users in either set. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-interview-candidates',
    'tags' => ['sql', 'self-join', 'union', 'step-by-step'],
];
