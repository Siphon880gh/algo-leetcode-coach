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
            'message' => "State:\nyou need the first index where a condition becomes true\n\nWhich template fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search for a boundary', 'next' => 'mid'],
                ['label' => 'Topological sort with BFS', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nFinding a boundary is the job of the binary search template.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou are about to write ok(mid)\n\nWhat do you do first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write one sentence saying what true means', 'next' => 'final'],
                ['label' => 'Guess where to put lo = mid + 1', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDefine the condition first, then the bounds follow.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ncourses with prerequisites\n\nWhich template fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Topological sort, with BFS or DFS cycle detection', 'next' => 'success'],
                ['label' => 'A sliding window over strings', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nOrdering by dependencies is a topological sort.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Keep the skeletons short.\n- Fill in the problem-specific parts carefully.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
