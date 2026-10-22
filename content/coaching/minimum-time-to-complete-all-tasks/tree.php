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
            'message' => "Read the problem statement above.\nProcess tasks in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By end time', 'next' => 's2'],
                ['label' => 'By start time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A long early task grabs seconds a short late one cannot share; Example 1 → 3 instead of 2.\nStep back to when you sorted by start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which free seconds to switch on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The earliest ones', 'next' => 'wrong_b'],
                ['label' => 'The latest ones in the window', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later tasks can only reuse late seconds; Example 2 → 6 instead of 4.\nStep back to when you filled from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n · T). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
