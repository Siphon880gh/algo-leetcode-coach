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
            'message' => "Read the problem statement above.\nEach operation can?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move x down and num up together', 'next' => 's2'],
                ['label' => 'Move only x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That closes the gap by 1; example 1 → 5 instead of 6.\nStep back to when you moved only x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then the answer is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num − 2t', 'next' => 'wrong_b'],
                ['label' => 'num + 2t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the smallest achievable x; example 1 → 2 instead of 6.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 6, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
