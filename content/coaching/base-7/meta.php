<?php
declare(strict_types=1);

return [
    'title' => 'Base 7: repeated division by 7, handle sign and zero',
    'leetcode' => 504,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: num (−1e7 to 1e7) to base 7. 0 → "0". Use |num|, take % 7 digits least significant first, divide by 7, then reverse and add "−" if negative. 100 → "202". −7 → "−10". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'strings', 'step-by-step'],
    'related_guide' => 'base-7',
];
