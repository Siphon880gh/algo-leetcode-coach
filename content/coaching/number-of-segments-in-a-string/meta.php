<?php
declare(strict_types=1);

return [
    'title' => 'Number of Segments in a String: count non-space run starts',
    'leetcode' => 434,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: count runs of non-space characters. Count index i when s[i] is not a space and i is 0 or s[i − 1] is a space. "Hello, my name is John" → 5. Extra, leading, and trailing spaces add nothing. Not 58 / 151. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'simulation', 'step-by-step'],
    'related_guide' => 'number-of-segments-in-a-string',
];
