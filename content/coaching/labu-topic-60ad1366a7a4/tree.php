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
            'message' => "State:\nneed first index where predicate becomes true\n\nTemplate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Boundary binary search', 'next' => 'mid'],
                ['label' => 'Topo BFS', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nBounds binary search fits.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nbefore coding ok(mid)\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sentence: what True means', 'next' => 'final'],
                ['label' => 'Guess lo=mid+1 randomly', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDefine the predicate first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ncourses with prerequisites\n\nTemplate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Topo BFS / DFS cycle detect', 'next' => 'success'],
                ['label' => 'Sliding window on strings', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nDependency order → topo.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Keep short skeletons\n- Fill problem-specific parts carefully\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
