<?php
declare(strict_types=1);

return [
    'title' => 'Number of Substrings Containing All Three Characters: last seen positions',
    'leetcode' => 1358,
    'difficulty' => 'Med',
    'summary' => 'For each end index i, track the last positions of a, b, and c. Every start up to the smallest of those positions gives a valid substring ending at i, adding min(last) + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'strings', 'leetcode'],
    'related_session' => 'number-of-substrings-containing-all-three-characters',
];
