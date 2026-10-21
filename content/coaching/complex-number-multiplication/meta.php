<?php
declare(strict_types=1);

return [
    'title' => 'Complex Number Multiplication: parse a+bi, apply (ac − bd) + (ad + bc)i',
    'leetcode' => 537,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: multiply "a+bi" strings. Split on the first "+", parse signed ints, compute (ac − bd) + (ad + bc)i, format as "re+imi" (negative imaginary prints as "+-"). "1+-1i" × "1+-1i" → "0+-2i". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'strings', 'simulation', 'step-by-step'],
    'related_guide' => 'complex-number-multiplication',
];
