<?php
declare(strict_types=1);

return [
    'title' => 'Earliest Finish Time for Land and Water Rides II: best first ride, then scan',
    'leetcode' => 3635,
    'difficulty' => 'Med',
    'summary' => 'If land goes first, only the earliest land finish F matters, because the end time max(F, ws[j]) + wd[j] grows with F. Scan the water rides with that F, do the same the other way round, and take the smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'two-pointers', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'earliest-finish-time-for-land-and-water-rides-ii',
];
