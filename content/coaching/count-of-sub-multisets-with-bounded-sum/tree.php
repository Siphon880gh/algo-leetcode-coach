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
            'message' => "Read the problem statement above.\nEqual values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One choice per count: 0 … c copies', 'next' => 's2'],
                ['label' => 'Each position is a separate choice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts the same multiset several times; examples 1 and 2 → 2 and 9 instead of 1 and 7.\nStep back to when you counted positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them', 'next' => 'wrong_b'],
                ['label' => 'Multiply by zeros + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each number of zeros is a different multiset; [0, 0, 1] with l = 0, r = 1 → 2 instead of 6.\nStep back to when you ignored zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√S · S). Examples → 1, 7, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
