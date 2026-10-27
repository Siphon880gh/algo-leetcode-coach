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
            'message' => "State:\nyou need first in, first out operations\n\nWhich ADT is that?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue', 'next' => 'mid'],
                ['label' => 'Binary heap', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nFirst in, first out is the queue ADT. A heap returns the highest priority item instead.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou are implementing the queue ADT\n\nWhich layout can work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A ring buffer, or linked nodes with head and tail pointers', 'next' => 'final'],
                ['label' => 'Only a balanced search tree', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nMany layouts can implement first in, first out.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsomeone says \"use a list\" while talking about O(1) index reads\n\nWhat should you ask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether it is backed by an array or by linked nodes, because index costs differ', 'next' => 'success'],
                ['label' => 'Nothing, because every list has O(1) index reads', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA linked list has to walk to reach an index, so it is not O(1).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Keep the ADT separate from the layout.\n- Pick the layout that makes your most frequent operation cheap.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
