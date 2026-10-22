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
            'message' => "Read the problem statement above.\nOdd number of mismatches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Fix the last one alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each operation flips two positions, so parity never changes; example 2 has 3 mismatches → −1.\nStep back to when you fixed one alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair mismatches how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fixed consecutive pairs', 'next' => 'wrong_b'],
                ['label' => 'DP: x/2 each, or distance to the previous', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Mismatches at 0, 5, 6, 11 with x = 3 cost 6 that way, but 4 is possible.\nStep back to when you fixed the pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
