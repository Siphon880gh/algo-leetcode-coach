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
            'message' => "Read the problem statement above.\narr[i] > arr[i−1]. New inc?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dec + 1', 'next' => 's2'],
                ['label' => 'inc + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Turbulent runs alternate, so a rise must follow a fall.\nStep back to when you extended the rise.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep both lengths', 'next' => 'wrong_b'],
                ['label' => 'Reset both lengths to 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A flat step breaks turbulence.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Updating inc and dec, use the old or new values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The old values: update both together', 'next' => 'success'],
                ['label' => 'Update inc first, then use it for dec', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The new inc would corrupt dec.\nStep back to when you updated in sequence.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [9,4,2,10,7,8,8,1,9] → 5. [4,8,12,16] → 2. [100] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
