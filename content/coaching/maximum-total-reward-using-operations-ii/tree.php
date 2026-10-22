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
            'message' => "Read the problem statement above.\nStore sums as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One big-integer bitset', 'next' => 's2'],
                ['label' => 'A set of sums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is about 5 · 10^9 steps.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shift which bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of f', 'next' => 'wrong_b'],
                ['label' => 'Only those below v', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sums ≥ v cannot take v: example 2 → 16 instead of 11.\nStep back to when you shifted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · M / 64). Examples → 4, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
