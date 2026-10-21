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
            'message' => "Read the problem statement above.\nRotate how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse rows, then transpose', 'next' => 's2'],
                ['label' => 'Transpose only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A transpose is a reflection, not a rotation.\nStep back to when you only transposed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only after rotating', 'next' => 'wrong_b'],
                ['label' => 'Before each rotation', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The unrotated matrix may already match.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many orientations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Four', 'next' => 'success'],
                ['label' => 'Two', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 90° steps give four distinct orientations.\nStep back to when you tried two.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
