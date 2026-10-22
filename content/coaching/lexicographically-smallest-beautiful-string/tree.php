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
            'message' => "Read the problem statement above.\nEach letter must differ from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous two', 'next' => 's2'],
                ['label' => 'The previous one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. aba is a palindrome too; s = abd, k = 4 → aca instead of acb.\nStep back to when you checked one letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After bumping position i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the rest as it was', 'next' => 'wrong_b'],
                ['label' => 'Refill the rest with the smallest valid letters', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The suffix can be smaller; s = abd, k = 4 → acd instead of acb.\nStep back to when you kept the suffix.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → abda, the empty string.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
