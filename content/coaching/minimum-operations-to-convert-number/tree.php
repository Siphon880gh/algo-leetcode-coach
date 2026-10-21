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
            'message' => "Read the problem statement above.\nWhich values do you expand?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only 0 … 1000', 'next' => 's2'],
                ['label' => 'Any value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Outside 0 … 1000 no further operation is allowed, and the search would never end.\nStep back to when you expanded everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A result outside 0 … 1000?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Discard it', 'next' => 'wrong_b'],
                ['label' => 'Still check whether it equals goal', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 reaches goal −4 in 2 operations.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS, so the first hit is the fewest operations', 'next' => 'success'],
                ['label' => 'DFS, return the first hit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. DFS can find a longer sequence first.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1001 · 3m). Examples → 2, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
