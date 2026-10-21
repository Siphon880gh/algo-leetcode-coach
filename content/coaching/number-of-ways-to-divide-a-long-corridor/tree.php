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
            'message' => "Read the problem statement above.\nOdd number of seats?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Put the extra seat in the last section', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every section needs exactly two seats; Example 3 (S) → 0.\nStep back to when you kept the extra seat.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where can a divider go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anywhere between two plants', 'next' => 'wrong_b'],
                ['label' => 'Between the 2nd seat of one pair and the 1st of the next', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A divider inside a pair leaves a section with one seat; Example 2 → 1.\nStep back to when you placed it inside a pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine the gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply their sizes', 'next' => 'success'],
                ['label' => 'Add them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. SSPPSSPSS has gaps 3 and 2: 6 ways, not 5.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
