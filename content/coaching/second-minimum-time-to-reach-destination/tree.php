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
            'message' => "Read the problem statement above.\nWhy count edges instead of minutes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every edge costs the same and all signals change together', 'next' => 's2'],
                ['label' => 'Signals differ per vertex', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All signals change at the same time, so time depends only on the number of edges.\nStep back to when you treated signals separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Second minimum means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The second path found, even if equally long', 'next' => 'wrong_b'],
                ['label' => 'Strictly larger than the minimum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second minimum of [2, 2, 4] is 4.\nStep back to when you allowed a tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Arriving while the signal is red?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wait until it turns green', 'next' => 'success'],
                ['label' => 'Leave anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You can only leave on green.\nStep back to when you left on red.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + E). Examples → 13, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
