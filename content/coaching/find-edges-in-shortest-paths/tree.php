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
            'message' => "Read the problem statement above.\nDistances from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both 0 and n − 1', 'next' => 's2'],
                ['label' => 'Only 0, testing d0[a] + w = d0[b]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That marks edges on shortest paths to any node: example 1 → all true instead of two false.\nStep back to when you used one source.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only a → b', 'next' => 'wrong_b'],
                ['label' => 'Test both a → b and b → a', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → all false instead of [true, false, false, true].\nStep back to when you tested one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log n). Unreachable n − 1 → all false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
