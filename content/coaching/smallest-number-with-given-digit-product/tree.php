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
            'message' => "Problem: Given a positive integer n, return, as a string, the smallest positive integer whose digits multiply to n. What to return when no such integer exists, and the limits, are in the official statement. For instance, 105 → 357 and 20 → 45, while 22 has no answer because of its factor 11. (Restated from memory; limits and examples may differ slightly.)\nTry digits in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '9 down to 2', 'next' => 's2'],
                ['label' => '2 up to 9', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Small digits waste length; in code 8 → 222 instead of 8.\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Something above 1 is left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append it as a digit', 'next' => 'wrong_b'],
                ['label' => 'There is no answer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It is not a digit; in code 22 → 211, whose digits multiply to 2.\nStep back to when you appended it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). The checks → 357, 45, and none for 22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
