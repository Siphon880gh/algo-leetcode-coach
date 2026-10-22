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
            'message' => "Read the problem statement above.\nDiffering pairs at a position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All pairs minus pairs with the same digit', 'next' => 's2'],
                ['label' => 'Σ c_a · c_b over ordered digit pairs a ≠ b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ordered pairs count each pair twice: example 1 → 8 instead of 4.\nStep back to when you used ordered pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs among c equal digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c²/2', 'next' => 'wrong_b'],
                ['label' => 'c(c − 1)/2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → −4 instead of 0.\nStep back to when you used c²/2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
