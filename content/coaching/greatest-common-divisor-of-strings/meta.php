<?php
declare(strict_types=1);

return [
    'title' => 'Greatest Common Divisor of Strings: commute, then gcd',
    'leetcode' => 1071,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: if str1 + str2 differs from str2 + str1 there is no divisor; otherwise take the prefix of length gcd of the two lengths. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'greatest-common-divisor-of-strings',
    'tags' => ['strings', 'math', 'step-by-step'],
];
