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
            'message' => "Read the problem statement above.\nReturn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many groups have the max size', 'next' => 's2'],
                ['label' => 'The max size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer counts groups.\nStep back to when you returned the size.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 to n', 'next' => 'wrong_b'],
                ['label' => '1 to n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 is not included.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Digit sum fast?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ds(i) = ds(i / 10) + i mod 10', 'next' => 'success'],
                ['label' => 'Recompute with strings each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Reusing earlier sums is O(1) each.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. n = 13 → 4. n = 2 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
