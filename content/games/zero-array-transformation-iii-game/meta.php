<?php
declare(strict_types=1);

return [
    'title' => 'Zero Array Transformation III',
    'leetcode' => 3362,
    'difficulty' => 'Med',
    'summary' => 'Scan indices left to right. Push the right ends of queries starting here into a max-heap. While the applied decrements at i are below nums[i], use the available query reaching furthest right (fail if none reaches i). Answer = unused queries.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'zero-array-transformation-iii',
    'related_session' => 'zero-array-transformation-iii',
];
