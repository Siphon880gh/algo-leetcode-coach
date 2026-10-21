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
            'message' => "Read the problem statement above.\nInclude the wrap pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, last to first', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [2,1,3,4] has one inner drop but fails at the wrap.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count as a drop', 'next' => 'wrong_b'],
                ['label' => 'Not a drop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Non-decreasing allows duplicates.\nStep back to when you counted equals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Allowed drops?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 1', 'next' => 'success'],
                ['label' => 'Exactly 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An unrotated or constant array has zero.\nStep back to when you required exactly one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
