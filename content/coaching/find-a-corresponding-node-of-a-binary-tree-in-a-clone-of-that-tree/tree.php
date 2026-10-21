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
            'message' => "Read the problem statement above.\nCompare by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reference to the target', 'next' => 's2'],
                ['label' => 'Value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The follow-up allows repeated values.\nStep back to when you compared values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Move in the clone how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search the clone separately', 'next' => 'wrong_b'],
                ['label' => 'Same child as in the original', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Lockstep keeps positions aligned.\nStep back to when you searched separately.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modify either tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Mark visited nodes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The trees must stay unchanged.\nStep back to when you marked them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [7,4,3,null,null,6,19], target 3 → the clone's node 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
