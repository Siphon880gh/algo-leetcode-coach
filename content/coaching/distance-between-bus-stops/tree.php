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
            'message' => "Read the problem statement above.\nstart > destination. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap them first', 'next' => 's2'],
                ['label' => 'Sum from start to the end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The slice would be empty.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recompute walking backwards', 'next' => 'wrong_b'],
                ['label' => 'total − clockwise', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The circle splits into two arcs.\nStep back to when you walked again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min of the two arcs', 'next' => 'success'],
                ['label' => 'The clockwise arc', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The other way may be shorter.\nStep back to when you kept clockwise.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4], 0 → 1: 1. 0 → 2: 3. 0 → 3: 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
