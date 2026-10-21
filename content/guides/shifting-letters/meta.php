<?php
declare(strict_types=1);

return [
    'title' => 'Shifting Letters: suffix sums of the shifts',
    'leetcode' => 848,
    'difficulty' => 'Med',
    'summary' => 'Letter i is shifted by shifts[i] + shifts[i + 1] + … + shifts[n − 1], a suffix sum. Sweep from the right, keep the running total mod 26, and shift each letter by it.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'strings', 'leetcode'],
    'related_session' => 'shifting-letters',
];
