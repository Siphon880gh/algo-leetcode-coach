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
            'message' => "Read the problem statement above.\nColour of a1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Black (sum 2, even)', 'next' => 's2'],
                ['label' => 'White', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 says a1 is black.\nStep back to when you called it white.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even sum → white', 'next' => 'wrong_b'],
                ['label' => 'Odd sum → white', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a1 has an even sum and is black.\nStep back to when you flipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need a board array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, parity suffices', 'next' => 'success'],
                ['label' => 'Yes, store all 64 squares', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Colours alternate with each step.\nStep back to when you built a board.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → false, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
