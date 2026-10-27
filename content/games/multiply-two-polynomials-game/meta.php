<?php
declare(strict_types=1);

return [
    'title' => 'Multiply Two Polynomials: FFT convolution',
    'leetcode' => 3549,
    'difficulty' => 'Hard',
    'summary' => 'The product coefficients are the convolution of the two coefficient arrays: coefficient i plus j gets poly1[i] times poly2[j]. A double loop costs n times m; an FFT (or NTT with an offset for negatives) is faster for big inputs. Round each floating result to the nearest integer.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['mini-game', 'leetcode', 'math'],
    'entry' => 'index.html',
    'related_guide' => 'multiply-two-polynomials',
    'related_session' => 'multiply-two-polynomials',
];
