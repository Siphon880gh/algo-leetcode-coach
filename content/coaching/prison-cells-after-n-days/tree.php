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
            'message' => "Read the problem statement above.\nSimulate 10⁹ days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the states repeat, so find the cycle', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is far too slow.\nStep back to when you simulated everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why must the states repeat?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They do not', 'next' => 'wrong_b'],
                ['label' => 'After day 1 only the 6 middle cells vary: 64 states', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The end cells become 0 and stay 0.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is day 0 part of the cycle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not necessarily: its end cells may be 1', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The cycle starts from day 1.\nStep back to when you included day 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(64 · 8). [0,1,0,1,1,0,0,1], n = 7 → [0,0,1,1,0,0,0,0]. [1,0,0,1,0,0,1,0], n = 1000000000 → [0,0,1,1,1,1,1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
