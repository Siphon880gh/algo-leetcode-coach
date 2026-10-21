<?php
declare(strict_types=1);

return [
    'title' => 'Design Browser History: cursor over an array',
    'leetcode' => 1472,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep pages, cur, and end; visit writes at cur + 1 and sets end; back/forward clamp cur within [0, end]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-browser-history',
    'tags' => ['design', 'array', 'stack', 'step-by-step'],
];
