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
            'message' => "Read the problem statement above.\nCache key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nested Maps keyed by each argument', 'next' => 's2'],
                ['label' => 'JSON.stringify(args)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Different objects stringify the same; Example 2 → calls 1, 1, 1 instead of 1, 2, 3.\nStep back to when you stringified.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is a result stored at the final node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check that the stored value is truthy', 'next' => 'wrong_b'],
                ['label' => 'Check with has', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A stored 0 looks missing; sum(0, 0) twice → 2 calls instead of 1.\nStep back to when you tested truthiness.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(arguments) per call. Examples → calls 1, 1, 2; 1, 2, 3; 1, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
