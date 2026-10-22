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
            'message' => "Read the problem statement above.\nUnused powers at bit i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Carry pairs to bit i + 1', 'next' => 's2'],
                ['label' => 'Drop them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two 1s can make a 2; [1, 1, 4] with target 2 → 1 instead of 0.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A bit is missing; split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest power', 'next' => 'wrong_b'],
                ['label' => 'The smallest larger power', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That costs extra splits; [2, 8] with target 1 → 3 instead of 1.\nStep back to when you split the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 31²). Examples → 1, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
