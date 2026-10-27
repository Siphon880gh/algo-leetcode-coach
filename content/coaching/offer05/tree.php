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
            'message' => "State:\ns = \"We are\" (length 6)\nspaces = 1\n\nWhat is the new length after replacing spaces with %20?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8, since each space adds 2 extra characters', 'next' => 'why_end'],
                ['label' => '6, since the length never changes', 'next' => 'w_len'],
            ],
        ],
        'w_len' => [
            'message' => "Wrong.\n\n`%20` is three characters, where the space was one. That adds 2 per space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'why_end' => [
            'message' => "State:\nthe buffer is already sized to length 8\n\nWhy fill it from the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'So the longer writes do not overwrite unread characters', 'next' => 'complex'],
                ['label' => 'Because % must always be written before letters', 'next' => 'w_pct'],
            ],
        ],
        'w_pct' => [
            'message' => "Wrong.\n\nThe letter order stays normal. Filling from the end is about not overwriting input you have not read yet.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'why_end',
            'choices' => [],
        ],
        'complex' => [
            'message' => "State:\ncount the spaces once, then write once\n\nWhat is the time cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²), for any approach', 'next' => 'w_quad'],
            ],
        ],
        'w_quad' => [
            'message' => "Wrong.\n\nOne counting pass plus one writing pass is linear.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'complex',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Count the spaces, then size the buffer.\n- Write `%20` starting from the end.\n- It takes O(n) time.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
