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
            'message' => "Read the problem statement above.\nCan a potion wait?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it flows without waiting', 'next' => 's2'],
                ['label' => 'Yes, wizards start when free', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 88 instead of 110.\nStep back to when you let it wait.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start time t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When wizard 0 is free', 'next' => 'wrong_b'],
                ['label' => 'max of done[i] − x · pre[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 34 instead of 110.\nStep back to when you only checked wizard 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → 110, 5, 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
