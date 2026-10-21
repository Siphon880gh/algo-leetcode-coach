<?php
declare(strict_types=1);

return [
    'title' => 'Construct Quad Tree: leaf if uniform, else four quadrants',
    'leetcode' => 427,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build a quad tree from an n by n 0/1 grid (n a power of two). A uniform square becomes a leaf with that value; a mixed square splits into four quadrants in the order top-left, top-right, bottom-left, bottom-right. [[0,1],[1,0]] → internal root with four leaves. Not 558. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'tags' => ['divide-and-conquer', 'trees', 'matrix', 'step-by-step'],
    'related_guide' => 'construct-quad-tree',
];
