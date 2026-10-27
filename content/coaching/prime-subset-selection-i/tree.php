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
            'message' => "Read the problem statement above.\nn = 15, s = 15. Which primes give the most picks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest ones first', 'next' => 'wrong_a'],
                ['label' => 'The smallest ones first', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 13 then 2 uses the whole budget for 2 picks, while 2, 3, 5 gives 3.\nStep back to when you started with 13.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 5, s = 1. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[]', 'next' => 'success'],
                ['label' => '[1]', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 is not prime, and the smallest prime 2 is over budget. The answer is [].\nStep back to when you picked 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sieve, then take the prefix that fits. Examples give [2, 3, 5, 7], three primes such as [2, 3, 5], and [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
