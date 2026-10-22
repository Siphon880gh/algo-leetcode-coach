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
            'message' => "Read the problem statement above.\nWho can swap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any two positions; values chain through gaps ≤ limit', 'next' => 's2'],
                ['label' => 'Only adjacent positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Swaps may be far apart; [3, 1, 2] with limit 1 stays [3, 1, 2] instead of [1, 2, 3].\nStep back to when you used adjacent swaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inside the groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the whole array', 'next' => 'wrong_b'],
                ['label' => 'Sorted values into the group’s sorted positions', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Far values cannot move; example 3 → [1, 7, 10, 19, 28] instead of [1, 7, 28, 19, 10].\nStep back to when you sorted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [1, 3, 5, 8, 9], [1, 6, 7, 18, 1, 2], [1, 7, 28, 19, 10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
