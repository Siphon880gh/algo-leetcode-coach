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
            'message' => "Read the problem statement above.\nWhole-array AND > 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 1', 'next' => 's2'],
                ['label' => 'Still cut greedily', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. No prefix reaches 0; example 2 → 0 instead of 1.\nStep back to when you skipped that case.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cut when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At each 0 element', 'next' => 'wrong_b'],
                ['label' => 'The running AND becomes 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pieces like [1, 2] also reach 0; example 1 → 2 instead of 3.\nStep back to when you cut at zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
