<?php
declare(strict_types=1);

return [
    'title' => 'Multiply Two Polynomials: FFT convolution',
    'leetcode' => 3549,
    'difficulty' => 'Hard',
    'summary' => 'The product’s coefficients are the convolution of the two coefficient arrays. A double loop costs O(n · m); an FFT (or NTT with an offset to handle negatives) does it in O((n + m) log(n + m)). Round each floating result to the nearest integer.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'leetcode'],
    'related_session' => 'multiply-two-polynomials',
];
