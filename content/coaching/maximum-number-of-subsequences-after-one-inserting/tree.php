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
            'message' => "Read the problem statement above.\nWhich letters to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L, C and T', 'next' => 's2'],
                ['label' => 'Only C', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 3 instead of 4.\nStep back to when you tried only C.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best place for an inserted L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The end', 'next' => 'wrong_b'],
                ['label' => 'The front', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"CT\" → 0 instead of 1.\nStep back to when you put L at the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
