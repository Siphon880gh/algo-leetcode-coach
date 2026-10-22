<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Alloys: clamp at 0, search past the budget',
    'leetcode' => 2861,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: clamp purchases at 0, and let the search reach budget + max(stock). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'maximum-number-of-alloys',
    'tags' => ['array', 'binary-search', 'step-by-step'],
];
