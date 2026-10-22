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
            'message' => "Read the problem statement above.\nLength from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Testing divisors', 'next' => 's2'],
                ['label' => 'n / gcd of letter counts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aabb → 2, but aa and bb are not anagrams; the answer is 4.\nStep back to when you used the gcd.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare which blocks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first two', 'next' => 'wrong_b'],
                ['label' => 'All of them with the first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ababaa → 2 instead of 3.\nStep back to when you checked two blocks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · divisors). Examples → 2, 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
