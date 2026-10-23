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
            'message' => "State:\nitem w=2,v=5,k=2,W=5\n\nBest value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10 — two copies', 'next' => 'mid'],
                ['label' => '15 — three copies somehow', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nk caps at 2 → value 10.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nlarge k\n\nOptimization?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary-split counts into 0-1 packs', 'next' => 'final'],
                ['label' => 'Always expand k singleton copies only', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nBinary splitting reduces item count.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nforward unbounded loop with no k check\n\nRisk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exceeds k copies', 'next' => 'success'],
                ['label' => 'Automatically respects k', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nUnbounded ignores k.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Bound copies by k\n- Expand or binary-split into 0-1\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
