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
            'message' => "Read the problem statement above.\nAn employee meets it when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hours ≥ target', 'next' => 's2'],
                ['label' => 'hours > target', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal counts; example 1 → 2 instead of 3.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Below target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop counting', 'next' => 'wrong_b'],
                ['label' => 'Skip that employee and continue', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later employees still count; example 1 → 0 instead of 3.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
