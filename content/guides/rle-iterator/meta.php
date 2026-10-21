<?php
declare(strict_types=1);

return [
    'title' => 'RLE Iterator: consume counts in place',
    'leetcode' => 900,
    'difficulty' => 'Med',
    'summary' => 'Keep an index into the run-length encoding. next(n) skips whole runs while they hold fewer than n items, then takes n from the current run and returns its value, or −1 if the runs run out.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'arrays', 'leetcode'],
    'related_session' => 'rle-iterator',
];
