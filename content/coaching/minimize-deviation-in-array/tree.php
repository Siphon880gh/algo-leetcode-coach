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
            'message' => "Read the problem statement above.\nWhy double odds first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Afterwards every value can only decrease', 'next' => 's2'],
                ['label' => 'To make them larger', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It unifies the moves so only halving remains.\nStep back to when you reasoned about growth.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which value to change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current minimum', 'next' => 'wrong_b'],
                ['label' => 'The current maximum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only lowering the max can shrink the gap now.\nStep back to when you changed the min.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The maximum is odd', 'next' => 'success'],
                ['label' => 'The heap is empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An odd max can no longer be lowered.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n log M). Examples → 1, 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
