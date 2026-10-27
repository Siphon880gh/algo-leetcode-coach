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
            'message' => "State:\nyou call list.contains n times on a list of size n\n\nWhat is the real time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²)', 'next' => 'mid'],
                ['label' => 'O(n), one call per i', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nEach contains call may scan all n elements.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyou build an immutable string with s += c for n characters\n\nWhat is the risk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) time spent copying', 'next' => 'final'],
                ['label' => 'None, it is always O(n)', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEach append may copy the whole string so far.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nthe code times out even though it is \"one loop\"\n\nWhat do you ask first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'What does each iteration cost?', 'next' => 'success'],
                ['label' => 'Delete the loop and hope', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nAudit the body of the loop.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Multiply by the cost of each iteration.\n- Watch out for slow library calls.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
