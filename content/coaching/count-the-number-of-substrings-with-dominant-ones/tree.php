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
            'message' => "Read the problem statement above.\nDominant when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ones ≥ zeros²', 'next' => 's2'],
                ['label' => 'ones ≥ zeros', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 6 instead of 5.\nStep back to when you dropped the square.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Enumerate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every substring', 'next' => 'wrong_b'],
                ['label' => 'Zero counts up to about √n per start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is about 8 · 10^8 substrings.\nStep back to when you tried every substring.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n √n). Examples → 5, 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
