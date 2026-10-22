<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Amount After Two Days of Conversions: value of each currency per day',
    'leetcode' => 3387,
    'difficulty' => 'Med',
    'summary' => 'Each day’s graph has no cycles, so every currency reachable from the start has one fixed value. Compute a[c] (day 1, from 1 unit of the start) and b[c] (day 2); converting c back on day 2 gives a[c] / b[c]. Take the maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'depth-first-search', 'breadth-first-search', 'array', 'string', 'leetcode'],
    'related_session' => 'maximize-amount-after-two-days-of-conversions',
];
