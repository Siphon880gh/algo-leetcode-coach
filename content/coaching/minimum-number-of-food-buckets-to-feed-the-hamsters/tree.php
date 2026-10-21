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
            'message' => "Read the problem statement above.\nA hamster with a bucket already on its left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Already fed; skip it', 'next' => 's2'],
                ['label' => 'Place another bucket', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One bucket is enough for a hamster.\nStep back to when you placed another.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where to place a new bucket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On the left if empty, else on the right', 'next' => 'wrong_b'],
                ['label' => 'On the right if empty, else on the left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In Example 2, .H.H., a right bucket at index 2 feeds both hamsters: 1 bucket, not 2.\nStep back to when you preferred the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both neighbours are hamsters or walls?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Skip that hamster', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every hamster must be fed; Example 3 → −1.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
