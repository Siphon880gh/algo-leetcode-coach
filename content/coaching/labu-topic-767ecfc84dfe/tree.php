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
            'message' => "State:\npermutations of [1,2] via backtracking\n\nLeaves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2! = 2 complete orders', 'next' => 'mid'],
                ['label' => '1 leaf only', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBoth orders appear as leaves.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\npartial path already violates a hard constraint\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prune — return', 'next' => 'final'],
                ['label' => 'Keep exploring hoping it fixes itself', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDead partials should prune.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nafter trying a choice\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Undo marks before the next sibling', 'next' => 'success'],
                ['label' => 'Leave marks for siblings', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nUndo is mandatory.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Decision tree + prune + undo\n- Explore feasible leaves\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
