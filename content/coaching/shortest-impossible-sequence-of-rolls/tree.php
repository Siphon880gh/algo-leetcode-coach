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
            'message' => "Read the problem statement above.\nMeasure what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rounds in which all k values appear', 'next' => 's2'],
                ['label' => 'The smallest count of any value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Order matters; Example 2 → 3 instead of 2.\nStep back to when you used counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a round closes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the set', 'next' => 'wrong_b'],
                ['label' => 'Start a fresh set', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every later roll closes a round; Example 1 → 6 instead of 3.\nStep back to when you kept the set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rounds + 1', 'next' => 'success'],
                ['label' => 'rounds', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every sequence of length rounds can be formed; Example 1 → 2 instead of 3.\nStep back to when you returned rounds.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
