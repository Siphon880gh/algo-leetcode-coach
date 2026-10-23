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
            'message' => "Problem: Write each digit of n as its English word (4 → four), join the words in order, and return how many distinct letters appear an odd number of times in that string. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount which letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those with an odd count', 'next' => 's2'],
                ['label' => 'Every distinct letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 11 → 3 instead of 0.\nStep back to when you counted distinct letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count = 1', 'next' => 'wrong_b'],
                ['label' => 'count % 2 = 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 777 → 0 instead of 3.\nStep back to when you tested for 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). Checks → 3, 0, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
