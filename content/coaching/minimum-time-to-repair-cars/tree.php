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
            'message' => "Read the problem statement above.\nCars a rank-r mechanic repairs in t minutes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'floor(√(t / r))', 'next' => 's2'],
                ['label' => 'floor(t / r)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n cars take r · n² minutes; Example 1 → 6 instead of 16.\nStep back to when you dropped the square root.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "t is enough when the total is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly cars', 'next' => 'wrong_b'],
                ['label' => 'At least cars', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equality is not monotone in t; Example 1 → 100 instead of 16.\nStep back to when you required equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log(min rank · cars²)). Examples → 16, 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
