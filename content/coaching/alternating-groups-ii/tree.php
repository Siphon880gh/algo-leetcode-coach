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
            'message' => "Read the problem statement above.\nThe circle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append the first k − 1 tiles', 'next' => 's2'],
                ['label' => 'Treat it as a line', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0 instead of 2.\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'run = k', 'next' => 'wrong_b'],
                ['label' => 'run ≥ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Longer runs hold several groups: example 1 → 1 instead of 3.\nStep back to when you required equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). Examples → 3, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
