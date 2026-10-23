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
            'message' => "State:\ns = \"We are\"  (length 6)\nspaces = 1\n\nNew length after replacing spaces with %20?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8 — each space adds 2 extra chars', 'next' => 'why_end'],
                ['label' => '6 — length never changes', 'next' => 'w_len'],
            ],
        ],
        'w_len' => [
            'message' => "Wrong.\n\n`%20` is three characters; a single space was one. Net +2 per space.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'why_end' => [
            'message' => "State:\npre-sized buffer length 8\n\nWhy fill from the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Expanding writes do not overwrite unread characters', 'next' => 'complex'],
                ['label' => 'Because % must be written before letters always', 'next' => 'w_pct'],
            ],
        ],
        'w_pct' => [
            'message' => "Wrong.\n\nLetter order stays normal. End-filling is about not clobbering unread input.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'why_end',
            'choices' => [],
        ],
        'complex' => [
            'message' => "State:\ncount spaces once, then write once\n\nTime class?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n)', 'next' => 'success'],
                ['label' => 'O(n²) required for any approach', 'next' => 'w_quad'],
            ],
        ],
        'w_quad' => [
            'message' => "Wrong.\n\nOne counting pass + one writing pass is linear.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'complex',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Count spaces → size buffer\n- Write `%20` from the end\n- O(n) time\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
