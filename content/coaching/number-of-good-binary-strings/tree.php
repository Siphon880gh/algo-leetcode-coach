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
            'message' => "Problem: Given a length range and two group sizes, count binary strings whose length lies in the range and in which every maximal block of 1s has a length that is a multiple of the first size and every maximal block of 0s a multiple of the second. Return the count modulo a large prime, as the official statement gives. For instance, lengths 2 to 3 with sizes 1 for ones and 2 for zeros → 5 (11, 00, 111, 100, 001). (Restated from memory; limits and examples may differ slightly.)\nAllowed block lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any multiple of the size', 'next' => 's2'],
                ['label' => 'Exactly the size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Longer multiples are good too; the case above → 3 instead of 5.\nStep back to when you fixed the block length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The answer adds dp over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the max length', 'next' => 'wrong_b'],
                ['label' => 'Every length from min to max', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shorter good strings count; the case above → 3 instead of 5.\nStep back to when you took dp[max] alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(maxLength). Constructed checks → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
