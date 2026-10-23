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
            'message' => "State:\nstairs f(i)=f(i-1)+f(i-2)\n\nFirst step in the playbook?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write/verify the recursive definition', 'next' => 'mid'],
                ['label' => 'Roll to two variables immediately', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nDefinition first; compression last.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\ntop-down works with memo\n\nNext often?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bottom-up table in dependency order', 'next' => 'final'],
                ['label' => 'Delete the recurrence and guess loops', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nTranslate the same recurrence downward.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\ndp[i] only needs i-1 and i-2\n\nCompress?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two variables', 'next' => 'success'],
                ['label' => 'Cannot compress ever', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nRolling is safe when live windows are tiny.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Brute → memo → table → compress\n- Same transition throughout\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
