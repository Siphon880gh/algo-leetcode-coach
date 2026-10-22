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
            'message' => "Read the problem statement above.\nEdge pairs in a column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive points only', 'next' => 's2'],
                ['label' => 'Every two points', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A column with 2 · 10^5 points has about 2 · 10^10 pairs.\nStep back to when you took every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Matching pair found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Accept it', 'next' => 'wrong_b'],
                ['label' => 'Check the box holds exactly 4 points', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 4 instead of −1.\nStep back to when you skipped the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, −1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
