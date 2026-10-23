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
            'message' => "State:\nlevel order\n\nStructure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue', 'next' => 'mid'],
                ['label' => 'Stack only', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBFS needs a queue.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\niterative preorder stack\n\nPush children order typically?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right then left so left pops first', 'next' => 'final'],
                ['label' => 'Left then right always without thinking', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nStack reverses push order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\niterative postorder hard part?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Knowing whether a node is expanded or ready to visit', 'next' => 'success'],
                ['label' => 'Impossible without recursion', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nPhase marks make it possible.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Queue for BFS; stack+phase for DFS orders\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
