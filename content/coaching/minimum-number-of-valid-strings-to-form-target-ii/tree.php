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
            'message' => "Read the problem statement above.\nCompute reach with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Z-function of word + # + target', 'next' => 's2'],
                ['label' => 'Trie walk from every position', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is up to 2.5 · 10^9 steps here.\nStep back to when you walked the trie.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then jump how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always to the end of the longest match', 'next' => 'wrong_b'],
                ['label' => 'Farthest reach within the frontier', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Words [ba, bb], target bba → −1 instead of 2.\nStep back to when you jumped to the longest match.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ|words| + |words| · |target|). Examples → 3, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
