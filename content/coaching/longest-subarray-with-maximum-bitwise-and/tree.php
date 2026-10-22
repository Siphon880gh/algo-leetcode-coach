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
            'message' => "Read the problem statement above.\nLargest possible AND?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest element', 'next' => 's2'],
                ['label' => 'The AND of the whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is the smallest possible AND; Example 1 → 6 instead of 2.\nStep back to when you used the whole array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of maxima', 'next' => 'wrong_b'],
                ['label' => 'The longest run of consecutive maxima', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Runs cannot join across smaller values; [3,1,3] → 2 instead of 1.\nStep back to when you counted every copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Run on a different value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That value is not part of the run; [3,1,3] → 2 instead of 1.\nStep back to when you restarted at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
