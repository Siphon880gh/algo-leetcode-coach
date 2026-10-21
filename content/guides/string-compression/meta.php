<?php
declare(strict_types=1);

return [
    'title' => 'String Compression: read pointer, write pointer, write the count digit by digit',
    'leetcode' => 443,
    'difficulty' => 'Med',
    'summary' => 'Compress runs in place: a char, then its run length if the length is more than 1, with lengths of 10 or more written as several digit chars. Return the new length. Read pointer finds each run; write pointer copies the char and the count digits. ["a","a","b","b","c","c","c"] → 6 (a2b2c3). Not 38 / 271.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'strings', 'leetcode'],
    'related_session' => 'string-compression',
];
