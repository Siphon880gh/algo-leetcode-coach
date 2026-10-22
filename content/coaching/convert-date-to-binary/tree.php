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
            'message' => "Read the problem statement above.\nPrefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strip 0b', 'next' => 's2'],
                ['label' => 'Keep bin output as is', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0b11101101100-0b1-0b1.\nStep back to when you kept 0b.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pad to 8 bits', 'next' => 'wrong_b'],
                ['label' => 'No leading zeros', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 11101101100-00000001-00000001.\nStep back to when you padded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 100000100000-10-11101, 11101101100-1-1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
