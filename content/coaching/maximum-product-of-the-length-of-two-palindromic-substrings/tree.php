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
            'message' => "Read the problem statement above.\nFind palindromes how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Manacher in O(n)', 'next' => 's2'],
                ['label' => 'Expand around every centre', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) on strings like aaaa…\nStep back to when you expanded naively.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Propagating pre[] leftwards?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre[i] = max(pre[i], pre[i + 1])', 'next' => 'wrong_b'],
                ['label' => 'pre[i] = max(pre[i], pre[i + 1] − 2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A palindrome ending later cannot end at i without trimming.\nStep back to when you dropped the −2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final combination?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max over i of pre[i] · suf[i + 1]', 'next' => 'success'],
                ['label' => 'Product of the two longest overall', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. They may overlap.\nStep back to when you ignored the cut.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
