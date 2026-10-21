<?php
declare(strict_types=1);

return [
    'title' => 'Complex Number Multiplication: parse a+bi, apply (ac − bd) + (ad + bc)i',
    'leetcode' => 537,
    'difficulty' => 'Med',
    'summary' => 'Multiply two complex numbers given as "a+bi" strings. Parse the real part before "+" and the imaginary part before "i" (it may be negative, as in "1+-1i"). The product is (ac − bd) + (ad + bc)i, written back as f"{re}+{im}i". "1+1i" × "1+1i" → "0+2i". "1+-1i" × "1+-1i" → "0+-2i".',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'strings', 'simulation', 'leetcode'],
    'related_session' => 'complex-number-multiplication',
];
