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
            'message' => "State:\nlists meet at node c1\np and q walking; one hits null\n\nNext?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Redirect that pointer to the other list’s head', 'next' => 'mid'],
                ['label' => 'Stop — no intersection possible', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nRedirect equalizes the remaining distance.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nintersection means?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same node reference, not merely equal values', 'next' => 'final'],
                ['label' => 'Equal values anywhere', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nShared suffix nodes are identity-equal.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nlengths m,n\n\nTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(m+n)', 'next' => 'success'],
                ['label' => 'O(mn) nested scans required', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nTwo pointers walk each list at most twice.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Switch heads at null\n- Meet at intersection or both null\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
