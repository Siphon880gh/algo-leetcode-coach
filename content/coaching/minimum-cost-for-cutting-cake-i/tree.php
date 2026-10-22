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
            'message' => "Read the problem statement above.\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Most expensive first', 'next' => 's2'],
                ['label' => 'Cheapest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 19 instead of 13.\nStep back to when you went cheapest first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A horizontal cut costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost once', 'next' => 'wrong_b'],
                ['label' => 'cost × vertical pieces so far', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A line crosses every piece: example 1 → 9 instead of 13.\nStep back to when you charged once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m + n log n). Examples → 13, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
