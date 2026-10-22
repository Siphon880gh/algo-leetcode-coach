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
            'message' => "Read the problem statement above.\nWork on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The string itself', 'next' => 's2'],
                ['label' => 'A number, dividing by 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Up to 1000 digits do not fit in a 64-bit integer.\nStep back to when you converted to a number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which zeros go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every 0', 'next' => 'wrong_b'],
                ['label' => 'Only those at the end', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inner zeros stay; example 1 → 51231 instead of 512301.\nStep back to when you removed every zero.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 512301, 123.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
