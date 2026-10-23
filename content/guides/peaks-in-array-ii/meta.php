<?php
declare(strict_types=1);

return [
    'title' => 'Peaks in Array II: a segment tree over peak positions',
    'leetcode' => 4017,
    'difficulty' => 'Hard',
    'summary' => 'Whether k is a peak depends only on its neighbours, and an update changes at most three of them. Inside [l, r], the peaks that count are p1 < … < pt in [l + 1, r − 1]. A subarray whose first interior peak is ps starts in [p(s−1), ps − 1] and ends after ps, so the count is Σ (ps − p(s−1)) · (r − ps) with p0 = l.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'divide-and-conquer', 'leetcode'],
    'related_session' => 'peaks-in-array-ii',
];
