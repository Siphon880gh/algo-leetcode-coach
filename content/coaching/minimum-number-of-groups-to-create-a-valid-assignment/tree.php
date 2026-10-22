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
            'message' => "Read the problem statement above.\nGroups per value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split counts into groups of size s or s + 1', 'next' => 's2'],
                ['label' => 'One group per value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Sizes may differ by at most 1; example 2 → 3 instead of 4.\nStep back to when you used one group each.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try s in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From 1 up', 'next' => 'wrong_b'],
                ['label' => 'From the smallest count down', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s = 1 always fits but uses more groups; example 1 → 3 instead of 2.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
