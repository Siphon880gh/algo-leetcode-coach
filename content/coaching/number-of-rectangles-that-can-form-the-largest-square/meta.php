<?php
declare(strict_types=1);

return [
    'title' => 'Number of Rectangles That Can Form the Largest Square: min side',
    'leetcode' => 1725,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: each rectangle gives a square of side min(l, w); track the maximum side and how many rectangles reach it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Array',
    'topic' => 'LeetCode · Array',
    'related_guide' => 'number-of-rectangles-that-can-form-the-largest-square',
    'tags' => ['array', 'counting', 'step-by-step'],
];
