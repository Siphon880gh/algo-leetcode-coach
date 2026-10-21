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
            'message' => "Read the problem statement above.\nSplit sizes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two numbers of 2 digits each', 'next' => 's2'],
                ['label' => 'A 3-digit and a 1-digit number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2932 → 223 + 9 = 232, but 23 + 29 = 52.\nStep back to when you used a 3 + 1 split.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tens digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two largest digits', 'next' => 'wrong_b'],
                ['label' => 'The two smallest digits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2932 → 32 + 92 = 124, not 52.\nStep back to when you put large digits in the tens.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A 0 among the digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine in a tens place', 'next' => 'success'],
                ['label' => 'Not allowed in front', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros are allowed; Example 2 → 04 + 09 = 13.\nStep back to when you refused the zero.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 52, 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
