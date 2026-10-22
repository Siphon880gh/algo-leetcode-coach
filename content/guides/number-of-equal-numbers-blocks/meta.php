<?php
declare(strict_types=1);

return [
    'title' => 'Number of Equal Numbers Blocks: binary search for each block’s end',
    'leetcode' => 2936,
    'difficulty' => 'Med',
    'summary' => 'This assumes every value appears in only one block. Then, from a block’s start, the positions holding the same value are a prefix of the rest, so binary search finds where it ends; jump past it and count.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'interactive', 'leetcode'],
    'related_session' => 'number-of-equal-numbers-blocks',
];
