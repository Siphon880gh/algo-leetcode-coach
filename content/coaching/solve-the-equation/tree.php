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
            'message' => "Read the problem statement above.\nWhat do you parse?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each side into (coefficient of x, constant)', 'next' => 's2'],
                ['label' => 'Only the left side; the right side is just a number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. x terms and constants can appear on both sides: x+5-3+x=6+x-2.\nStep back to when you ignored the right side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the coefficient of a bare x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '1 (−1 for -x, and 0 for 0x)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x alone means 1 · x; only the term 0x has coefficient 0.\nStep back to when you read x as 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The x coefficients cancel (a − c = 0). Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"Infinite solutions" if the constants match, else "No solution"', 'next' => 'success'],
                ['label' => 'Return "x=0"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With no x left, the equation is either always true or never true.\nStep back to when you returned x=0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Collect terms, (a − c)x = d − b, special-case a = c: O(n) time. \"x+5-3+x=6+x-2\" → \"x=2\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
