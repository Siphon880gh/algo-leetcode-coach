<?php
declare(strict_types=1);

return [
    'title' => 'Process Restricted Friend Requests: check the groups, not the people',
    'leetcode' => 2076,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: compare restrictions by root, change nothing on a failed request, union on success. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'process-restricted-friend-requests',
    'tags' => ['union-find', 'graph', 'step-by-step'],
];
