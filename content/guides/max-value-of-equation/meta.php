<?php
declare(strict_types=1);

return [
    'title' => 'Max Value of Equation: monotonic deque on y − x',
    'leetcode' => 1499,
    'difficulty' => 'Hard',
    'summary' => 'For i < j, yi + yj + |xi − xj| = (yi − xi) + (yj + xj). Scan j and keep a deque of earlier points within distance k, ordered by decreasing y − x; the front gives the best partner.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['monotonic-queue', 'sliding-window', 'heap', 'leetcode'],
    'related_session' => 'max-value-of-equation',
];
