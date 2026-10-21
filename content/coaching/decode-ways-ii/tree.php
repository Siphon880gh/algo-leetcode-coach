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
            'message' => "Read the problem statement above.\nExpand every * into its 9 digits and count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: same DP, the star changes how many ways each step has', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 9 to the power of the number of stars.\nStep back to when you expanded the stars.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A single * on its own decodes in how many ways?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10', 'next' => 'wrong_b'],
                ['label' => '9: it stands for 1 to 9', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A star is never 0.\nStep back to when you counted 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The pair ** decodes in how many ways?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '15: 11–19 and 21–26', 'next' => 'success'],
                ['label' => '26', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Both stars are 1–9, so the valid two-digit codes are only 11–19 and 21–26.\nStep back to when you counted every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. f[i] = one · f[i − 1] + two · f[i − 2] with the star cases, mod 1e9 + 7: O(n) time, O(1) space. \"*\" → 9. \"1*\" → 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
