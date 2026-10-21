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
            'message' => "Read the problem statement above.\nNeed a sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the digit is the slot', 'next' => 's2'],
                ['label' => 'Sort words alphabetically', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Alphabetical order ignores the positions.\nStep back to when you sorted by text.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Slot index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'digit', 'next' => 'wrong_b'],
                ['label' => 'digit − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Positions are 1-indexed.\nStep back to when you used the digit directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Word text?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strip the last character', 'next' => 'success'],
                ['label' => 'Keep it whole', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output has no digits.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"This is a sentence\", \"Me Myself and I\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
