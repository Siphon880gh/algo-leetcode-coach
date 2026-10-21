<?php
declare(strict_types=1);

return [
    'title' => 'Ambiguous Coordinates: split, then decimal-place each part',
    'leetcode' => 816,
    'difficulty' => 'Med',
    'summary' => 'Strip the parentheses and try every split into an x part and a y part. Each part can become a few valid numbers: the plain integer if it has no leading zero, and every decimal placement whose integer part has no leading zero and whose fraction does not end in 0. Pair them all.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'enumeration', 'leetcode'],
    'related_session' => 'ambiguous-coordinates',
];
