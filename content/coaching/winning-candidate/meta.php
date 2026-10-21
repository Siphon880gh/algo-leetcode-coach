<?php
declare(strict_types=1);

return [
    'title' => 'Winning Candidate: count, take the top, then the name',
    'leetcode' => 574,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: group votes by candidateId, take the top count with ORDER BY … LIMIT 1, and join to Candidate for the name. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'winning-candidate',
    'tags' => ['database', 'sql', 'group-by', 'step-by-step'],
];
