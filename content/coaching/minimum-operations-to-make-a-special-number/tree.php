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
            'message' => "Read the problem statement above.\nEndings to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '00, 25, 50 and 75', 'next' => 's2'],
                ['label' => 'Only 00 and 50', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Multiples of 25 also end in 25 and 75; 725 → 3 instead of 0.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No ending fits but there is a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete everything: n', 'next' => 'wrong_b'],
                ['label' => 'Keep it: n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0 is special; example 3 → 2 instead of 1.\nStep back to when you deleted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
