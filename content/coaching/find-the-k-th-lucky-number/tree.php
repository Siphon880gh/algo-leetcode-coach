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
            'message' => "Problem: A lucky number uses only the digits 4 and 7. Given k, return the k-th smallest lucky number. The return type and limits are in the official statement. For instance, the lucky numbers begin 4, 7, 44, 47, 74, 77, 444, so k = 4 → 47 and k = 10 → 477. (Restated from memory; limits and examples may differ slightly.)\nWrite in binary?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k + 1', 'next' => 's2'],
                ['label' => 'k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Everything shifts by one; k = 4 → 44 instead of 47.\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Map the bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 → 7, 1 → 4', 'next' => 'wrong_b'],
                ['label' => '0 → 4, 1 → 7', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The order flips; k = 4 → 74 instead of 47.\nStep back to when you swapped the digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k). The checks → 4, 47, 477.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
