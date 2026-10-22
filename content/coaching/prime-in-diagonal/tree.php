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
            'message' => "Read the problem statement above.\nWhich values to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both diagonals', 'next' => 's2'],
                ['label' => 'The main diagonal only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The other diagonal counts too; nums = [[1,2,3],[4,5,6],[7,8,9]] → 5 instead of 7.\nStep back to when you skipped the anti-diagonal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is 1 prime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, nothing divides it', 'next' => 'wrong_b'],
                ['label' => 'No, primes are greater than 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Primes start at 2; nums = [[1]] → 1 instead of 0.\nStep back to when you accepted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √max). Examples → 11, 17.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
