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
            'message' => "Read the problem statement above.\nWhich 6?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 's2'],
                ['label' => 'The rightmost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Higher places add more value.\nStep back to when you took the rightmost.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 6s', 'next' => 'wrong_b'],
                ['label' => 'At most one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only one digit may change.\nStep back to when you changed them all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No 6 at all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the number unchanged', 'next' => 'success'],
                ['label' => 'Change a 9 to 6', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That lowers the number.\nStep back to when you changed a 9.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). 9669 → 9969. 9996 → 9999. 9999 → 9999.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
