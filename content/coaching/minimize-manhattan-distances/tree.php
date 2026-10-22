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
            'message' => "Read the problem statement above.\nLargest distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Larger spread of x + y or x − y', 'next' => 's2'],
                ['label' => 'Spread of x plus spread of y', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That overestimates: example 1 → 13 instead of 12.\nStep back to when you added the spreads.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which removals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every point, with an O(n) rescan', 'next' => 'wrong_b'],
                ['label' => 'The points at the four extremes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²), about 10^10 at n = 10^5.\nStep back to when you tried every point.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 12, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
