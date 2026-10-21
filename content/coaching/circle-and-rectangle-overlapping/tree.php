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
            'message' => "Read the problem statement above.\nTest only the corners?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: clamp to the closest point', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An edge can be closer than any corner.\nStep back to when you tested corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Floating square roots', 'next' => 'wrong_b'],
                ['label' => 'Squared distances', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Squares avoid rounding.\nStep back to when you took roots.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Touching?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts as overlap', 'next' => 'success'],
                ['label' => 'Does not count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The comparison is ≤.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). First example → true. Second → false. Third → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
