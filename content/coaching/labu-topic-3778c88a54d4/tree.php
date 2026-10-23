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
            'message' => "State:\ntwo children, at least one boy, equal likelihood\n\nP(both boys)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1/3', 'next' => 'mid'],
                ['label' => '1/2', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\n conditioned space has 3 outcomes, one is BB.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nfirst step on such puzzles\n\n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Enumerate equally likely outcomes', 'next' => 'final'],
                ['label' => 'Trust intuition immediately', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nEnumeration beats vibes.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ncondition “at least one boy” removes?\n\n",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GG', 'next' => 'success'],
                ['label' => 'BB', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nGG has no boy.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Enumerate → condition → count\n- Here 1/3\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
