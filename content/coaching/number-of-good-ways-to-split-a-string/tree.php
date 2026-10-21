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
            'message' => "Read the problem statement above.\nRecount with a set per split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Split positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allow an empty part', 'next' => 'wrong_b'],
                ['label' => 'Both parts non-empty', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement needs non-empty parts.\nStep back to when you allowed empties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre[i] == suf[i + 1]', 'next' => 'success'],
                ['label' => 'pre[i] == suf[i]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s[i] belongs to the left part.\nStep back to when you shared it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"aacaba\" → 2. \"abcd\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
