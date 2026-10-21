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
            'message' => "Read the problem statement above.\nNeed a closed form?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, simulation is O(n²) for n ≤ 1000', 'next' => 's2'],
                ['label' => 'Yes, simulation is too slow', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. About 10^6 steps is cheap.\nStep back to when you ruled out simulation.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update in place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, build a new array each round', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reads would see already-overwritten values.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count before or after the check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each round, then check', 'next' => 'success'],
                ['label' => 'Check first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The start is already the identity; the answer must be non-zero.\nStep back to when you checked first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 1, 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
