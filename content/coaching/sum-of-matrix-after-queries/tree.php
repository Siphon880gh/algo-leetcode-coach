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
            'message' => "Read the problem statement above.\nReplay the queries in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last to first', 'next' => 's2'],
                ['label' => 'First to last, skipping lines already set', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Later writes overwrite earlier ones; example 1 → 17 instead of 23.\nStep back to when you went forwards.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store the sum in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 32-bit integer', 'next' => 'wrong_b'],
                ['label' => 'A 64-bit integer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It can reach 10^4 · 10^4 · 10^5 = 10^13.\nStep back to when you chose 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q). Examples → 23, 17.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
