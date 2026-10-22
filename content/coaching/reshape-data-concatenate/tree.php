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
            'message' => "Read the problem statement above.\nCall?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pd.concat([df1, df2])', 'next' => 's2'],
                ['label' => 'pd.concat(df1, df2)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. concat wants a list of frames; this raises TypeError.\nStep back to when you passed them separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Axis?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'axis=1', 'next' => 'wrong_b'],
                ['label' => 'Rows (default)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That puts them side by side: 4 rows × 6 columns.\nStep back to when you set axis=1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). The example → students 1 … 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
