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
            'message' => "Read the problem statement above.\nv must be a multiple of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest m with m² mod k = 0', 'next' => 's2'],
                ['label' => 'k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. baab with k = 4 → 0 instead of 1.\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i mod m', 'next' => 'wrong_b'],
                ['label' => 'i mod 2m', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The length is 2v; ab with k = 2 → 1 instead of 0.\nStep back to when you used mod m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + √k). Examples → 2, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
