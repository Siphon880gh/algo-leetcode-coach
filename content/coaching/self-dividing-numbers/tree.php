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
            'message' => "Read the problem statement above.\nA digit is 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reject the number', 'next' => 's2'],
                ['label' => 'Skip that digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A number containing 0 is not self-dividing.\nStep back to when you skipped the 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which number do you divide by each digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The remaining t after peeling', 'next' => 'wrong_b'],
                ['label' => 'The original x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Divisibility is about the whole number.\nStep back to when you divided t.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is brute force over the range fast enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: at most 10⁴ numbers with 5 digits each', 'next' => 'success'],
                ['label' => 'No, use a sieve', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The range is small enough for a direct check.\nStep back to when you reached for a sieve.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((right − left) · digits). left = 1, right = 22 → [1,2,3,4,5,6,7,8,9,11,12,15,22].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
