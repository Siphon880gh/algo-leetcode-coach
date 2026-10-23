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
            'message' => "State:\nqueue = [3, 1, 4]  (front is 3)\naction = dequeue\n\nWhat returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 — FIFO, front leaves first', 'next' => 'bfs'],
                ['label' => '4 — LIFO, rear leaves first', 'next' => 'w_lifo'],
            ],
        ],
        'w_lifo' => [
            'message' => "Wrong.\n\nLIFO is a stack. A queue is FIFO — front first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bfs' => [
            'message' => "State:\ngraph BFS from node A\nneighbors of A must be visited level by level\n\nWhich structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Queue — enqueue neighbors, dequeue next to visit', 'next' => 'arr'],
                ['label' => 'Stack only — always pop the newest neighbor', 'next' => 'w_stack'],
            ],
        ],
        'w_stack' => [
            'message' => "Wrong.\n\nNewest-first is DFS-shaped. BFS needs FIFO ordering.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bfs',
            'choices' => [],
        ],
        'arr' => [
            'message' => "State:\n\"queue\" implemented as array pop(0) each dequeue\n\nCost class per dequeue?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n) — shifting; use a deque/ring buffer for O(1)', 'next' => 'success'],
                ['label' => 'Still O(1) — pop(0) never shifts', 'next' => 'w_pop0'],
            ],
        ],
        'w_pop0' => [
            'message' => "Wrong.\n\nRemoving the first slot of a contiguous array shifts the rest.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'arr',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- FIFO: enqueue rear, dequeue front\n- BFS uses a queue\n- Prefer O(1) deque, not array pop(0)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
