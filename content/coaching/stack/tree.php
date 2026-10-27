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
            'message' => "State:\nstack = [3, 1, 4] (4 is on top)\naction: pop\n\nWhat is returned?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4, because LIFO means the top comes off first', 'next' => 'brackets'],
                ['label' => '3, because FIFO means the bottom comes off first', 'next' => 'w_fifo'],
            ],
        ],
        'w_fifo' => [
            'message' => "Wrong.\n\nFIFO describes a queue. A stack is LIFO, so the top comes off first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'brackets' => [
            'message' => "State:\ninput = \"([])\"\nscanning from left to right\n\nWhen you reach the final ')', what should be on top of the stack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '\'(\', which you pop to match this closing bracket', 'next' => 'mid'],
                ['label' => '\'[\', since any opening bracket is fine', 'next' => 'w_any'],
            ],
        ],
        'w_any' => [
            'message' => "Wrong.\n\nA closing bracket must match the most recent unmatched opening bracket, which is the top.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'brackets',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou often need to remove the bottom element\n\nIs a plain stack the right structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. Use a deque (or a list) if both ends matter.', 'next' => 'success'],
                ['label' => 'Yes. A stack still gives O(1) access to the middle and bottom.', 'next' => 'w_mid'],
            ],
        ],
        'w_mid' => [
            'message' => "Wrong.\n\nA stack only promises access to the top. Reaching the bottom or middle breaks that and is usually O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- LIFO: push, pop and peek at the top in O(1).\n- Classic uses are brackets, undo and DFS frames.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
