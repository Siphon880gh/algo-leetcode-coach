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
            'message' => "Read the problem statement above.\nWhat is the distance between adjacent 1s, as in \"11\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1: the difference of their positions', 'next' => 's2'],
                ['label' => '0: there are no zeros between them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The distance is measured between positions, not zeros.\nStep back to when you counted zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you remember while scanning?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of zeros seen so far', 'next' => 'wrong_b'],
                ['label' => 'The position of the last 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leading zeros would be counted as a gap.\nStep back to when you counted zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "There is only one 1. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => 'The number of bits', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A gap needs a 1 at both ends.\nStep back to when you returned the bit count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). 22 → 2. 8 → 0. 5 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
