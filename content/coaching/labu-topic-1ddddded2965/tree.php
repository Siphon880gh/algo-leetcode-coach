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
            'message' => "State:\nreverse a list; about to change cur.next\n\nFirst?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Save nxt = cur.next', 'next' => 'mid'],
                ['label' => 'Set cur.next = prev immediately with no save', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nSave the forward link first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ndelete head possibly\n\nHelper?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dummy node before head', 'next' => 'final'],
                ['label' => 'No helper ever', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nDummy unifies edge cases.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nfind middle\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fast/slow pointers', 'next' => 'success'],
                ['label' => 'Hash every node index first always', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nFast/slow is the classic O(1)-space mid.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Dummy, fast/slow, save-next\n- Draw before rewiring\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
