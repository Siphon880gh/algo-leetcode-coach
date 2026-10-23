<?php
declare(strict_types=1);

return [
    'title' => 'Finish Time of Tasks II: reroot with top-two values',
    'leetcode' => 3967,
    'difficulty' => 'Hard',
    'summary' => 'Compute each subtree finish time from root 0, then pass the parent side down. For a child c, the parent side is the finish time of v without c, which needs only the two largest and two smallest neighbor values.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'finish-time-of-tasks-ii',
];
