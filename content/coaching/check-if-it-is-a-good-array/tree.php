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
            'message' => "Read the problem statement above.\nSearch for coefficients?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: Bézout says gcd = 1 is enough', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The gcd decides it.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Need a coprime pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: 6, 10, 15 has gcd 1 with no coprime pair', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The whole set's gcd is what matters.\nStep back to when you looked for a pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Use a subset or all numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All: more numbers can only lower the gcd', 'next' => 'success'],
                ['label' => 'Choose the best subset', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adding numbers never raises the gcd.\nStep back to when you searched subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). [12,5,7,23] → true. [29,6,10] → true. [3,6] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
