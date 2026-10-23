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
            'message' => "Read the problem statement above.\nPrevious value u for a new v?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'u ≤ v', 'next' => 's2'],
                ['label' => 'u < v', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 1] → 6 instead of 10.\nStep back to when you required a strict increase.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Values from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 to 5000', 'next' => 'wrong_b'],
                ['label' => '0 to 5000', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [0] → 0 instead of 1.\nStep back to when you skipped 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 5001). Examples → 6, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
