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
            'message' => "State:\ndeque = [10, 20]\nactions: push_front 5, then pop_back\n\nWhat is the deque now?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[5, 10], because the front gained 5 and the back lost 20', 'next' => 'bfs'],
                ['label' => '[10, 20, 5], because push_front really appends', 'next' => 'w_front'],
            ],
        ],
        'w_front' => [
            'message' => "Wrong.\n\npush_front adds at the front, giving [5, 10, 20]. Then pop_back removes 20, leaving [5, 10].\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'bfs' => [
            'message' => "State:\nplain breadth-first search in level order\n\nDo you need both ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. A one-ended queue is enough.', 'next' => 'win'],
                ['label' => 'Yes. BFS must pop from the back every time.', 'next' => 'w_bfs'],
            ],
        ],
        'w_bfs' => [
            'message' => "Wrong.\n\nBFS only needs first in, first out. Using both ends is optional.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'bfs',
            'choices' => [],
        ],
        'win' => [
            'message' => "State:\nthe sliding-window maximum pattern\n\nWhy does a monotonic deque help?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You drop useless indexes from the back and expired ones from the front', 'next' => 'success'],
                ['label' => 'Because a deque keeps the window sorted automatically', 'next' => 'w_sort'],
            ],
        ],
        'w_sort' => [
            'message' => "Wrong.\n\nThe deque does not sort anything. You keep its order yourself by popping from the ends.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'win',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Both ends are O(1).\n- Use a deque when both ends matter. Otherwise a stack or a queue is clearer.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
