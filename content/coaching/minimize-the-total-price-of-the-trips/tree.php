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
            'message' => "Read the problem statement above.\nHow to handle several trips?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count visits over all trips, then one DP', 'next' => 's2'],
                ['label' => 'Run the DP per trip and add', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each trip would pick its own halving set; n = 2, edges = [[0,1]], price = [2,2], trips = [[0,0],[1,1]] → 2 instead of 3.\nStep back to when you split by trip.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Children of a halved node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cheaper of full and halved', 'next' => 'wrong_b'],
                ['label' => 'Full price only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adjacent nodes cannot both be halved; Example 1 → 20 instead of 23.\nStep back to when you let children be halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · trips). Examples → 23, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
