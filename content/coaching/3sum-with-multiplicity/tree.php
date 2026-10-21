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
            'message' => "Read the problem statement above.\nLoop over index triples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: loop over value triples using counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³) for n up to 3000.\nStep back to when you looped over indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "x == y == z. How many index triples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c[x]³', 'next' => 'wrong_b'],
                ['label' => 'C(c[x], 3)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The three indices must differ and order does not matter.\nStep back to when you cubed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "x == y < z. How many?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(c[x], 2) · c[z]', 'next' => 'success'],
                ['label' => 'c[x]² · c[z]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The two indices with value x must differ.\nStep back to when you squared.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 101²). [1,1,2,2,3,3,4,4,5,5], target 8 → 20. [1,1,2,2,2,2], target 5 → 12. [2,1,3], target 6 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
