<?php
declare(strict_types=1);

return [
    'title' => 'Maximum of Minimum Values in All Subarrays: span of each minimum',
    'leetcode' => 1950,
    'difficulty' => 'Med',
    'summary' => 'For each element, a monotonic stack gives the widest window where it is the minimum (width w). It is a candidate for size w; then sweep from large sizes to small, taking a running max, since a candidate for size w also works for smaller sizes.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'array', 'leetcode'],
    'related_session' => 'maximum-of-minimum-values-in-all-subarrays',
];
