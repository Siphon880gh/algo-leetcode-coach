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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start W at floor(sqrt(area)) and step down', 'next' => 's2'],
                ['label' => 'Start W at 1 and step up, keeping the best pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Going up from 1 always scans all the way to sqrt(area) and needs best-pair bookkeeping. Starting from sqrt stops at the first hit.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "W = floor(sqrt(area)).\nWhen do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Step W up until it divides area', 'next' => 'wrong_b'],
                ['label' => 'At the first W with area % W == 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stepping W up past sqrt makes W > L, which breaks L ≥ W.\nStep back to when you stepped W up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The largest divisor ≤ sqrt(area) gives the closest pair. W = 1 always divides, so the loop ends. Return [area / W, W].\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From sqrt down, first divisor, return [area / W, W]', 'next' => 'success'],
                ['label' => 'Return [W, area / W]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The order is [L, W] with L ≥ W. [W, L] puts the smaller first.\nStep back to when you returned [W, L].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Down from sqrt to the first divisor. 122122 → [427,286].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
