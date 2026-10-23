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
            'message' => "Read the problem statement above.\nFree copies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them', 'next' => 's2'],
                ['label' => 'Ignore them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 8 instead of 10.\nStep back to when you ignored free copies.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Free copies per copy bought?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every copy earns them', 'next' => 'wrong_b'],
                ['label' => 'Only the first copy earns them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 16 instead of 10.\nStep back to when you repeated the bonus.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² + n · budget). Examples → 4, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
