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
            'message' => "Read the problem statement above.\nUse floating point and convert back at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep an exact numerator and denominator', 'next' => 's2'],
                ['label' => 'Yes: sum as floats, then turn the result into a fraction', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1/3 is not exact in binary, and recovering a fraction from a float is guesswork.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you add a/b to num/den?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num += a and den += b', 'next' => 'wrong_b'],
                ['label' => 'num = num · b + a · den, den = den · b, then divide both by their gcd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1/2 + 1/2 would give 2/4 instead of 1.\nStep back to when you added the parts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The result is 2. How do you print it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"2/1"', 'next' => 'success'],
                ['label' => '"2"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output is always a fraction, so a whole number has denominator 1.\nStep back to when you dropped the denominator.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. An exact running fraction reduced by the gcd: O(n) time. \"-1/2+1/2\" → \"0/1\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
