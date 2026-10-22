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
            'message' => "Read the problem statement above.\nWhich counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd for a1, even for a2', 'next' => 's2'],
                ['label' => 'Any counts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 3.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest even count', 'next' => 'wrong_b'],
                ['label' => 'Smallest even count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. aaaaabbcccc → 1 instead of 3.\nStep back to when you took the largest.",
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
