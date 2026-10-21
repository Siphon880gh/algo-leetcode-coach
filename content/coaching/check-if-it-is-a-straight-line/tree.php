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
            'message' => "Read the problem statement above.\nCompare slopes with division?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: cross-multiply', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Vertical lines divide by zero.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test for point (x, y)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dx · (x − x0) == dy · (y − y0)', 'next' => 'wrong_b'],
                ['label' => 'dx · (y − y0) == dy · (x − x0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That swaps the axes.\nStep back to when you paired x with dx.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Only two points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'success'],
                ['label' => 'false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two points always lie on a line.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). First example → true. Second → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
