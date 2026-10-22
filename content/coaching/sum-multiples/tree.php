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
            'message' => "Read the problem statement above.\nAfter f(3) + f(5) + f(7)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract f(15), f(21), f(35)', 'next' => 's2'],
                ['label' => 'Stop there', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 15 is counted twice; n = 15 → 96 instead of 81.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After subtracting the pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop there', 'next' => 'wrong_b'],
                ['label' => 'Add f(105)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 105 was added three times and removed three times; n = 105 → 2940 instead of 3045.\nStep back to when you skipped f(105).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 21, 40, 30.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
