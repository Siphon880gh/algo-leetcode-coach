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
            'message' => "Read the problem statement above.\nAlice wins when x + y is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd', 'next' => 's2'],
                ['label' => 'Even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 1 instead of 0.\nStep back to when you picked even.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count of odd-sum pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · ⌊n / 2⌋ · ⌊m / 2⌋', 'next' => 'wrong_b'],
                ['label' => '⌊n · m / 2⌋', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you halved each side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
