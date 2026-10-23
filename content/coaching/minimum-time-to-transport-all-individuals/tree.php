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
            'message' => "Read the problem statement above.\nDoes the stage matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, it is part of the state', 'next' => 's2'],
                ['label' => 'No, use mul[0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 15.00 instead of 14.50.\nStep back to when you ignored the stage.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return trip uses which stage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The stage before the crossing', 'next' => 'wrong_b'],
                ['label' => 'The stage after the crossing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 17.50 instead of 14.50.\nStep back to when you used the old stage.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · 3^n · n · log(m · 2^n)). Examples → 5.00, 14.50, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
