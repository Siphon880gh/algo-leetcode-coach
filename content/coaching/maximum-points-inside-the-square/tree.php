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
            'message' => "Read the problem statement above.\nBound from each tag?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its second-smallest distance', 'next' => 's2'],
                ['label' => 'Its smallest distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One point per tag is fine: example 1 → 0 instead of 2.\nStep back to when you used the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count points with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd ≤ bound', 'next' => 'wrong_b'],
                ['label' => 'd < bound', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The boundary is inside: example 3 → 2 instead of 0.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
