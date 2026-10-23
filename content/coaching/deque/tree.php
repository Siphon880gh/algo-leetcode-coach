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
            'message' => "State:\ndeque = [10, 20]\naction = push_front 5, then pop_back\n\nResulting deque?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[5, 10] — front gained 5, back lost 20', 'next' => 'bfs'],
                ['label' => '[10, 20, 5] — front push actually appends', 'next' => 'w_front'],
            ],
        ],
        'w_front' => [
            'message' => "Wrong.\n\npush_front inserts at the front: [5, 10, 20], then pop_back → [5, 10].\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bfs' => [
            'message' => "State:\nplain BFS level order\n\nDo you need both ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — a single-ended queue is enough', 'next' => 'win'],
                ['label' => 'Yes — BFS must pop_back every time', 'next' => 'w_bfs'],
            ],
        ],
        'w_bfs' => [
            'message' => "Wrong.\n\nBFS only needs FIFO. Deque both-ends power is optional.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bfs',
            'choices' => [],
        ],
        'win' => [
            'message' => "State:\nsliding-window maximum pattern\n\nWhy a monotonic deque helps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop useless indices from the back; expire old ones from the front', 'next' => 'success'],
                ['label' => 'Because deques sort the window automatically', 'next' => 'w_sort'],
            ],
        ],
        'w_sort' => [
            'message' => "Wrong.\n\nYou maintain the mono invariant yourself with end pops — the deque does not auto-sort.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'win',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Both ends O(1)\n- Use a deque when both ends matter; else stack/queue is clearer\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
