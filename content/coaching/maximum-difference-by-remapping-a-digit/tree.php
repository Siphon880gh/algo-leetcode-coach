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
            'message' => "Read the problem statement above.\nDigit to raise to 9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first digit that is not 9', 'next' => 's2'],
                ['label' => 'The first digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A leading 9 cannot grow; Example 2 → 90 instead of 99.\nStep back to when you took the first digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which copies change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first copy', 'next' => 'wrong_b'],
                ['label' => 'Every copy of that digit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A remap changes all occurrences; Example 1 → 90000 instead of 99009.\nStep back to when you changed one copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). Examples → 99009, 99.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
