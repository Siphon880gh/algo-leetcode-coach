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
            'message' => "Read the problem statement above.\nLeading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Do not change the balance', 'next' => 's2'],
                ['label' => 'Count as even digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 7 looks like 07 and balanced; example 2 → 6 instead of 1.\nStep back to when you counted leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f(high) − f(low)', 'next' => 'wrong_b'],
                ['label' => 'f(high) − f(low − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. low itself drops out; low = high = 12 with k = 3 → 0 instead of 1.\nStep back to when you subtracted f(low).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(10 · 20 · k · 10). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
