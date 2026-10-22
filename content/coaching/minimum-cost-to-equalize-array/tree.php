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
            'message' => "Read the problem statement above.\nTargets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max through 2 · max', 'next' => 's2'],
                ['label' => 'max only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 3, 3], cost1 = 10, cost2 = 1 → 20 instead of 4.\nStep back to when you fixed the target.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs available?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total / 2', 'next' => 'wrong_b'],
                ['label' => 'min(total / 2, total − largest gap)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A pair needs two different indices: example 1 → 7 instead of 15.\nStep back to when you ignored the gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + max); reduce mod at the end. Examples → 15, 6, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
