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
            'message' => "Read the problem statement above.\nSome value is not a multiple of the minimum m?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer is 1', 'next' => 's2'],
                ['label' => 'Ignore it and count copies of m', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x mod m makes a new, unique minimum that clears everything; [2, 2, 2, 3] → 2 instead of 1.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "c copies of m leave?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊c / 2⌋', 'next' => 'wrong_b'],
                ['label' => '⌈c / 2⌉', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [5, 5, 5] → 1 instead of 2.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
