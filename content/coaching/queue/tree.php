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
            'message' => "State:\nqueue = [3, 1, 4] (3 is at the front)\naction: dequeue\n\nWhat is returned?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3, because FIFO means the front leaves first', 'next' => 'bfs'],
                ['label' => '4, because LIFO means the rear leaves first', 'next' => 'w_lifo'],
            ],
        ],
        'w_lifo' => [
            'message' => "Wrong.\n\nLIFO describes a stack. A queue is FIFO, so the front leaves first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bfs' => [
            'message' => "State:\nBFS on a graph, starting from node A\nA's neighbors must be visited level by level\n\nWhich structure do you use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A queue: enqueue the neighbors, and dequeue the next node to visit', 'next' => 'arr'],
                ['label' => 'Only a stack, always popping the newest neighbor', 'next' => 'w_stack'],
            ],
        ],
        'w_stack' => [
            'message' => "Wrong.\n\nNewest first gives DFS order. BFS needs FIFO order.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bfs',
            'choices' => [],
        ],
        'arr' => [
            'message' => "State:\na \"queue\" built on an array, using pop(0) for each dequeue\n\nWhat does each dequeue cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n), because of shifting; use a deque or ring buffer for O(1)', 'next' => 'success'],
                ['label' => 'Still O(1), because pop(0) never shifts', 'next' => 'w_pop0'],
            ],
        ],
        'w_pop0' => [
            'message' => "Wrong.\n\nRemoving the first slot of a contiguous array shifts everything after it.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'arr',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- FIFO: enqueue at the rear, dequeue from the front.\n- BFS uses a queue.\n- Use an O(1) deque, not array pop(0).\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
