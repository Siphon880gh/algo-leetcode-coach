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
            'message' => "Problem: You get n sheets in a row and m colors, where color i may cover at most limit[i] sheets. Paint every sheet using exactly two different colors, each forming one contiguous block. Count the ways modulo 10^9 + 7; two ways differ when some sheet gets a different color. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWays for an ordered pair (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, c_i + c_j − n + 1)', 'next' => 's2'],
                ['label' => 'min(c_i, c_j)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): n = 5, limit = [4, 2, 3] → 14 instead of 12.\nStep back to when you used the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count (i, j) and (j, i) separately?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, once per pair', 'next' => 'wrong_b'],
                ['label' => 'Yes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): the same input → 6 instead of 12.\nStep back to when you merged them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m). Constructed checks → 12, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
