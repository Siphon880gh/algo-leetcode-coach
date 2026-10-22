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
            'message' => "Read the problem statement above.\nA created one costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 moves', 'next' => 's2'],
                ['label' => '1 move', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Create next to Alice, then swap it in: example 2 → 2 instead of 4.\nStep back to when you charged 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Use changes when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when ones run out', 'next' => 'wrong_b'],
                ['label' => 'For whatever the ones at i − 1, i, i + 1 miss', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A far one costs at least 2: example 1 → 4 instead of 3.\nStep back to when you saved the changes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n) with prefix sums. Examples → 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
