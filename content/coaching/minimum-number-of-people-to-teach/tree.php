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
            'message' => "Read the problem statement above.\nWho might need teaching?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only people in friendships with no common language', 'next' => 's2'],
                ['label' => 'Everyone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Friendships that already work need nothing.\nStep back to when you included everyone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many languages may be taught?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any number', 'next' => 'wrong_b'],
                ['label' => 'Exactly one, so try each', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement allows choosing one language.\nStep back to when you taught several.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count a person twice if in two broken friendships?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use a set', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Teaching a person once covers all their friendships.\nStep back to when you double counted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n + F · n). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
