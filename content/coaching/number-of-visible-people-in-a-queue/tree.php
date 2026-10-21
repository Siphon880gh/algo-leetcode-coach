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
            'message' => "Read the problem statement above.\nScan direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 's2'],
                ['label' => 'Left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each person looks to the right.\nStep back to when you scanned left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After popping shorter people?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Add 1 if the stack is non-empty', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first taller person is also visible.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Popped people for later persons?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hidden behind the current person', 'next' => 'success'],
                ['label' => 'Still visible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Someone taller now stands in front of them.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [3,1,2,1,1,0], [4,1,1,1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
