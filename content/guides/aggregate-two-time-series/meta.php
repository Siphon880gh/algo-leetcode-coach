<?php
declare(strict_types=1);

return [
    'title' => 'Aggregate Two Time Series: merge with two pointers',
    'leetcode' => 4001,
    'difficulty' => 'Med',
    'summary' => 'Walk the union of timestamps in order. For each series, move its pointer to the first timestamp ≥ the current one and take that value, or 0 when the series has ended.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'leetcode'],
    'related_session' => 'aggregate-two-time-series',
];
