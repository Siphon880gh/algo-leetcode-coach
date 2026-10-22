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
            'message' => "Read the problem statement above.\nStrong test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|x − y| ≤ min(x, y)', 'next' => 's2'],
                ['label' => '|x − y| ≤ max(x, y)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That accepts every pair; example 2 → 110 instead of 0.\nStep back to when you used max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Only self-pairs are strong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer −1', 'next' => 'wrong_b'],
                ['label' => 'Answer 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A number may pair with itself, giving 0; example 2 → −1 instead of 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 7, 0, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
