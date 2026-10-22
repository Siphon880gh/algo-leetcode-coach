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
            'message' => "Read the problem statement above.\nArrangements of one word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len! / Π count!', 'next' => 's2'],
                ['label' => 'len!', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Repeated letters give identical strings; Example 1 → 36 instead of 18.\nStep back to when you used len! alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the words by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adding', 'next' => 'wrong_b'],
                ['label' => 'Multiplying', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each word is arranged independently; Example 1 → 9 instead of 18.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 18, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
