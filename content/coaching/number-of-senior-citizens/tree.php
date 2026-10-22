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
            'message' => "Read the problem statement above.\nWhere is the age?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two characters after the gender, indexes 11 and 12', 'next' => 's2'],
                ['label' => 'The last two characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Those are the seat; 7868190130M7522 → 22 instead of 75.\nStep back to when you read the end of the string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A passenger aged exactly 60?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counted', 'next' => 'wrong_b'],
                ['label' => 'Not counted, it must be above 60', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement says strictly more than 60; a detail with age 60 → 1 instead of 0.\nStep back to when you counted 60.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
