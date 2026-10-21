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
            'message' => "Read the problem statement above.\nBuild a height array of size n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, n reaches 10^9', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Work with the restrictions only.\nStep back to when you allocated n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sweeps needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left-to-right only', 'next' => 'wrong_b'],
                ['label' => 'Left-to-right and right-to-left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A low limit on the right can lower earlier ones.\nStep back to when you swept once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Peak between (x1, h1), (x2, h2)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(h1 + h2 + x2 − x1) // 2', 'next' => 'success'],
                ['label' => 'max(h1, h2) + (x2 − x1)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The height must also descend to h2.\nStep back to when you ignored the right limit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(r log r). Examples → 2, 5, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
