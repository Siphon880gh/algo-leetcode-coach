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
            'message' => "Problem: Open windows are listed from top to bottom. Each query brings one window to the top. Return the order after all queries. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWalk the queries?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last to first', 'next' => 's2'],
                ['label' => 'First to last', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 3] with 2, 3 → [2, 3, 1] instead of [3, 2, 1].\nStep back to when you walked forwards.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Untouched windows go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On top', 'next' => 'wrong_b'],
                ['label' => 'Below, in their old order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 2, 3] with 3, 3, 2 → [1, 2, 3] instead of [2, 3, 1].\nStep back to when you put them on top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). The guide’s checks → [2, 3, 1], [2, 4, 1, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
