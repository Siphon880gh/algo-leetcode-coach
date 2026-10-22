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
            'message' => "Read the problem statement above.\nOrder the indices by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums2 ascending', 'next' => 's2'],
                ['label' => 'Their original order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A slow grower gets a late slot; nums1 = [6, 4, 6], nums2 = [0, 6, 1], x = 1 → −1 instead of 3.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From 1 up to n', 'next' => 'wrong_b'],
                ['label' => 'From n down to 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One index is reset twice; example 1 → 2 instead of 3.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
