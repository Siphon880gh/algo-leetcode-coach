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
            'message' => "Read the problem statement above.\nDeck limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n²', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 4.\nStep back to when you ignored the deck.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weight limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈maxWeight / w⌉', 'next' => 'wrong_b'],
                ['label' => '⌊maxWeight / w⌋', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 3, w = 5, maxWeight = 21 → 5 instead of 4.\nStep back to when you rounded up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 4, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
