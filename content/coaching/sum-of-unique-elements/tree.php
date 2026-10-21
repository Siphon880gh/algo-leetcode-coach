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
            'message' => "Read the problem statement above.\nUnique means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Appears exactly once', 'next' => 's2'],
                ['label' => 'Distinct values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A value seen twice is not unique.\nStep back to when you summed distinct values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add on first sight?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, subtract later on repeats', 'next' => 'wrong_b'],
                ['label' => 'No, count first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A third copy would confuse add/subtract bookkeeping.\nStep back to when you added on first sight.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Counting structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Array of size 101', 'next' => 'success'],
                ['label' => 'Sort and compare neighbours only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting works but a small array is simpler.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 0, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
