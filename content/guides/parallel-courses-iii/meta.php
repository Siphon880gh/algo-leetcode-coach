<?php
declare(strict_types=1);

return [
    'title' => 'Parallel Courses III: longest weighted path in a DAG',
    'leetcode' => 2050,
    'difficulty' => 'Hard',
    'summary' => 'A course can finish at its time plus the latest finish among its prerequisites. Process courses in topological order (Kahn) computing finish[v] = time[v] + max finish of prerequisites; the answer is the maximum finish.',
    'category' => 'LeetCode',
    'subcategory' => 'Topological Sort',
    'topic' => 'LeetCode · Topological Sort',
    'kind' => 'algo',
    'tags' => ['topological-sort', 'graph', 'dynamic-programming', 'leetcode'],
    'related_session' => 'parallel-courses-iii',
];
