<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: Two arrays hold the coefficients of polynomials A(x) and B(x), with index i holding the coefficient of x^i. Return the coefficient array of A(x) · B(x), which has length len(A) + len(B) − 1. The method assumes the arrays can be long enough that the plain double loop is too slow. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nConvert the floating output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Round to the nearest integer', 'next' => 's2'],
                ['label' => 'Truncate with int()', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With numpy, [−572, −268] × [672, −421, −111, 542] gives 60715 instead of 60716 for x¹.\nStep back to when you truncated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Result length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(len(A), len(B))', 'next' => 'wrong_b'],
                ['label' => 'len(A) + len(B) − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 2] × [3, 4] → [3, 10] instead of [3, 10, 8].\nStep back to when you cut it short.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log(n + m)). Checks → [3, 10, 8], [−2, 2, 1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
