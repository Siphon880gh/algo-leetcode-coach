<?php
declare(strict_types=1);

return [
    'title' => 'Process Restricted Friend Requests: union-find with a restriction scan',
    'leetcode' => 2076,
    'difficulty' => 'Hard',
    'summary' => 'Keep friend groups in union-find. For a request, find both roots; accept if they are equal, or if no restriction has its two people in exactly those two groups. Then union.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'graph', 'leetcode'],
    'related_session' => 'process-restricted-friend-requests',
];
