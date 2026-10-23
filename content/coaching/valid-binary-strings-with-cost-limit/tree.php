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
            'message' => "Read the problem statement above.\nCost index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0-based', 'next' => 's2'],
                ['label' => '1-based', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [\"000\", \"100\"] instead of [\"000\", \"010\", \"100\"].\nStep back to when you shifted the indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Place 1 right after a 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the cost fits', 'next' => 'wrong_b'],
                ['label' => 'Never', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 4 strings, including \"110\", instead of 3.\nStep back to when you allowed adjacent ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(F · n). Examples → [\"000\", \"010\", \"100\"], [\"0\", \"1\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
