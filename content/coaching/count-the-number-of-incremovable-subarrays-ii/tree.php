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
            'message' => "Read the problem statement above.\nPrefix to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest strictly increasing prefix', 'next' => 's2'],
                ['label' => 'Longest non-decreasing prefix', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal neighbours break the rest; example 3 → 4 instead of 3.\nStep back to when you allowed equals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add per suffix start j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1', 'next' => 'wrong_b'],
                ['label' => 'i + 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Starts 0 … i + 1 are i + 2 choices; example 2 → 3 instead of 7.\nStep back to when you used i + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 10, 7, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
