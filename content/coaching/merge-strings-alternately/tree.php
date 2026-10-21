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
            'message' => "Read the problem statement above.\nWhich word first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'word1', 'next' => 's2'],
                ['label' => 'The longer word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement starts with word1.\nStep back to when you chose by length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min of the two lengths', 'next' => 'wrong_b'],
                ['label' => 'max of the two lengths', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stopping at the shorter drops the tail.\nStep back to when you used min.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Building the result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Collect in a list and join', 'next' => 'success'],
                ['label' => 'Concatenate in a loop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Repeated concatenation can be quadratic.\nStep back to when you concatenated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). Examples → apbqcr, apbqrs, apbqcd.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
