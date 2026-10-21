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
            'message' => "Read the problem statement above.\nEnds match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[i + 1][j − 1]', 'next' => 's2'],
                ['label' => '1 + dp[i + 1][j − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Matching ends need no insertion.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ends differ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 + dp[i + 1][j − 1]', 'next' => 'wrong_b'],
                ['label' => '1 + min(dp[i + 1][j], dp[i][j − 1])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One insertion mirrors one end.\nStep back to when you added 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equivalent shortcut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − LPS', 'next' => 'success'],
                ['label' => 'Number of mismatched pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Insertions can realign the string.\nStep back to when you counted mismatches.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). \"zzazz\" → 0. \"mbadm\" → 2. \"leetcode\" → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
