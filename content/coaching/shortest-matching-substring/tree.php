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
            'message' => "Read the problem statement above.\nPick a, b, c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nearest around each b', 'next' => 's2'],
                ['label' => 'First a, then the first b and c', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. s = abbba, p = *b* → 2 instead of 1.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Empty piece?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never occurs', 'next' => 'wrong_b'],
                ['label' => 'Occurs at every position', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s = a, p = ** → −1 instead of 0.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + |p|). Examples → 8, −1, 0, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
