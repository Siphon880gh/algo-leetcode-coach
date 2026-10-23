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
            'message' => "State:\nstack = [3, 1, 4]  (top is 4)\naction = pop\n\nWhat returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4 — LIFO, top comes off first', 'next' => 'brackets'],
                ['label' => '3 — FIFO, bottom comes off first', 'next' => 'w_fifo'],
            ],
        ],
        'w_fifo' => [
            'message' => "Wrong.\n\nFIFO is a queue. A stack is LIFO — top first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'brackets' => [
            'message' => "State:\ninput = \"([]\")\nscanning left to right\n\nOn seeing ')', what should the stack top be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => "'(' — pop it to match this close", 'next' => 'mid'],
                ['label' => "'[' — any open bracket is fine", 'next' => 'w_any'],
            ],
        ],
        'w_any' => [
            'message' => "Wrong.\n\nThe closer must match the most recent unmatched opener — the top.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'brackets',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nneed to remove the bottom element often\n\nIs a pure stack the right ADT?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No — use a deque (or list) if both ends matter', 'next' => 'success'],
                ['label' => 'Yes — stack mid/bottom ops are still O(1)', 'next' => 'w_mid'],
            ],
        ],
        'w_mid' => [
            'message' => "Wrong.\n\nStack contract is top-only. Bottom/mid access breaks the ADT and is usually O(n).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- LIFO: push/pop/peek top in O(1)\n- Classic uses: brackets, undo, DFS frames\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
