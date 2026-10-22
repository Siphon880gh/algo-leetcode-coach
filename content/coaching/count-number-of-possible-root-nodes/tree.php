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
            'message' => "Read the problem statement above.\nRoot moves from u to child v. Change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lose (u, v), gain (v, u)', 'next' => 's2'],
                ['label' => 'Lose (v, u), gain (u, v)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The edge now points from v to u; Example 1 → 5 instead of 3.\nStep back to when you swapped the pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count a root when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt > k', 'next' => 'wrong_b'],
                ['label' => 'cnt ≥ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. At least k correct guesses is enough; Example 1 → 0 instead of 3.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + g). Examples → 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
