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
            'message' => "Read the problem statement above.\nPlacement?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n in the middle, then alternate sides', 'next' => 's2'],
                ['label' => '1 … n in order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 20 instead of 23.\nStep back to when you placed them in order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "m = n (a cycle)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Score it as a path', 'next' => 'wrong_b'],
                ['label' => 'Add first · last', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 80 instead of 82.\nStep back to when you left out the closing edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 23, 82.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
