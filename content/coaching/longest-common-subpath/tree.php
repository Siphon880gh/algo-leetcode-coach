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
            'message' => "Read the problem statement above.\nWhy binary search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A common length-L subpath implies one of length L − 1', 'next' => 's2'],
                ['label' => 'Answers are evenly spaced', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Monotonicity is what allows it.\nStep back to when you gave another reason.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Hashing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One 32-bit modulus', 'next' => 'wrong_b'],
                ['label' => 'Two moduli (or a 61-bit modulus plus another)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Tests target single-hash collisions.\nStep back to when you used one small modulus.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "City 0 in the hash?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map c to c + 1', 'next' => 'success'],
                ['label' => 'Use c directly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros would make [0, 1] and [1] collide.\nStep back to when you used 0 as a digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(S log S). Examples → 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
