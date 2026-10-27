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
            'message' => "Read the problem statement above.\nn = 12, s = 8. Take the largest prime first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, 7 gets close to 8', 'next' => 'wrong_a'],
                ['label' => 'No, find the best reachable sum with a DP', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 3 + 5 = 8 hits the budget exactly. Largest first gives [7] instead of [3, 5].\nStep back to when you grabbed 7.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 2: [5, 13] and [7, 11] both reach 18 with two primes. Which one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[7, 11], the closer values', 'next' => 'wrong_b'],
                ['label' => '[5, 13], the smaller first element', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties go to the lexicographically smaller list, and 5 < 7.\nStep back to when you picked [7, 11].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Suffix subset-sum table, then rebuild smallest first. O(m · s). Examples give [2, 3, 5, 7], [5, 13] and [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
