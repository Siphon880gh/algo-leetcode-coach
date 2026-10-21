<?php
declare(strict_types=1);

return [
    'title' => 'Next Closest Time: enumerate the 256 candidates',
    'leetcode' => 681,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build every time from the allowed digits, keep the valid ones, and pick the smallest forward gap with wraparound. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'next-closest-time',
    'tags' => ['strings', 'enumeration', 'step-by-step'],
];
