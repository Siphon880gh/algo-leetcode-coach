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
            'message' => "Read the problem statement above.\nOn a duplicate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shrink from the left until it is gone', 'next' => 's2'],
                ['label' => 'Restart the window at r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values between the duplicates may stay.\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why sum and length agree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They do not need to', 'next' => 'wrong_b'],
                ['label' => 'All values are positive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With positive values a wider unique window ending at r has a larger sum.\nStep back to when you dismissed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Data structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Set (or last-index map)', 'next' => 'success'],
                ['label' => 'Sorted list', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Membership tests suffice.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 17, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
