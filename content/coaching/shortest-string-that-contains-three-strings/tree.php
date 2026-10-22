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
            'message' => "Read the problem statement above.\nMerge in which orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 6', 'next' => 's2'],
                ['label' => 'Only a, b, c', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The best order varies; example 1 → abcaaa instead of aaabca.\nStep back to when you fixed the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "t is already inside s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still append with the best overlap', 'next' => 'wrong_b'],
                ['label' => 'Return s', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a = abc, b = b, c = c → abcb instead of abc.\nStep back to when you skipped the containment check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(6 · L²). Examples → aaabca, aba.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
