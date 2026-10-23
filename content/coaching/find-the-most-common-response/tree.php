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
            'message' => "Read the problem statement above.\nDuplicates within a day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count once', 'next' => 's2'],
                ['label' => 'Count each copy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → ok instead of good.\nStep back to when you counted every copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie on the count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First one seen', 'next' => 'wrong_b'],
                ['label' => 'Lexicographically smallest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → good instead of bad.\nStep back to when you took the first seen.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total responses). Examples → good, bad.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
