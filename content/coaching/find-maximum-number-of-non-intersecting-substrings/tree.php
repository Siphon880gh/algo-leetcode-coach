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
            'message' => "Read the problem statement above.\nAfter counting a substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clear the remembered positions', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 2 instead of 1.\nStep back to when you let substrings overlap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ends allowed when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i − first ≥ 2', 'next' => 'wrong_b'],
                ['label' => 'i − first ≥ 3 (length ≥ 4)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. aba → 1 instead of 0.\nStep back to when you allowed length 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
