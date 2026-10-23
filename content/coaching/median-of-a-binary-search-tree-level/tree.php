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
            'message' => "Problem: You get the root of a binary search tree and a level number, with the root at level 0. Return the median of the values on that level, taking the larger of the two middle values when the count is even, or −1 if the level has no nodes. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRoot level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [20, 10, 30, 5, 15, 25, 40] at level 1 → 20 instead of 30.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Even count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lower middle', 'next' => 'wrong_b'],
                ['label' => 'Upper middle, index ⌊c / 2⌋', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): the same tree at level 2 → 15 instead of 25.\nStep back to when you took the lower one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 30, 25, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
