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
            'message' => "Read the problem statement above.\nMark what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent pairs with the same parity', 'next' => 's2'],
                ['label' => 'Even elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two odd neighbours also break it, and [1, 6] is special even though 6 is even: example 2 → [false, false] instead of [false, true].\nStep back to when you marked even elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range [f, t] is special when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[t] − p[f − 1] = 0', 'next' => 'wrong_b'],
                ['label' => 'p[t] − p[f] = 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts the pair (f − 1, f), outside the range: example 2 → [false, false] instead of [false, true].\nStep back to when you used p[f − 1].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [false], [false, true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
