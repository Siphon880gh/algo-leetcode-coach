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
            'message' => "State:\nn=10, maximize product of positive breaks\n\nStrong partition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3+3+2+2 → 36', 'next' => 'mid'],
                ['label' => '5+5 → 25', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThrees (with 2s) beat 5+5 here.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nremainder would be 1 after taking a 3\n\nFix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use 2+2 instead of 3+1', 'next' => 'final'],
                ['label' => 'Keep the 1 — it does not change product', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMultiplying by 1 wastes a break; 2+2 is better.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nprefer parts near?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'success'],
                ['label' => '7', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nReal analysis favors 3s (and 2s).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Prefer 3s; fix remainder 1 via 2+2\n- Product 36 for n=10\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
