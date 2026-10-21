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
            'message' => "Read the problem statement above.\nHandle rotations how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Windows of s + s', 'next' => 's2'],
                ['label' => 'Simulate each rotation separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Patterns to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only 0101…', 'next' => 'wrong_b'],
                ['label' => 'Both 0101… and 1010…', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The other pattern may need fewer flips.\nStep back to when you used one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Update when sliding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the new index, remove the old one', 'next' => 'success'],
                ['label' => 'Recount the window', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Recounting makes it quadratic.\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
