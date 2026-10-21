<?php
declare(strict_types=1);

return [
    'title' => 'Path With Maximum Minimum Value: best-first search',
    'leetcode' => 1102,
    'difficulty' => 'Med',
    'summary' => 'Expand cells from the start in order of value, highest first, with a max-heap. Track the smallest value popped so far; when the bottom-right cell comes out, that minimum is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'heap', 'union-find', 'binary-search', 'leetcode'],
    'related_session' => 'path-with-maximum-minimum-value',
];
