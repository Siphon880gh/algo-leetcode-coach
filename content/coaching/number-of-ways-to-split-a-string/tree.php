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
            'message' => "Read the problem statement above.\nt not divisible by 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Try anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal thirds are impossible.\nStep back to when you tried anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "t = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 1', 'next' => 'wrong_b'],
                ['label' => '(n − 1)(n − 2) / 2 mod 1e9+7', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any two cut points work.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gap1 × gap2', 'next' => 'success'],
                ['label' => 'gap1 + gap2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The two cuts are independent choices.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"10101\" → 4. \"1001\" → 0. \"0000\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
