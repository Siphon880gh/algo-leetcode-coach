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
            'message' => "Read the problem statement above.\nWindow [3, 5, 3]. Next value 2. Does it break the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, 2 is not the sum of two values', 'next' => 'wrong_a'],
                ['label' => 'Yes, 5 − 3 = 2, so 2 + 3 = 5', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2 completes the triple as an addend. Tracking only sums gives 5 instead of 3.\nStep back to when you checked sums only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Once a bad triple is inside, can a longer window around it be valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, so the left end only moves right', 'next' => 'success'],
                ['label' => 'Yes, if it is long enough', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A longer window still holds the same three indices.\nStep back to when you let the window grow past it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two pointers with pair sum and difference counts. O(n²). Examples give 3 and 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
