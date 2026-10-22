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
            'message' => "Read the problem statement above.\nNew block when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'word[i] ≤ word[i − 1]', 'next' => 's2'],
                ['label' => 'word[i] < word[i − 1]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A repeated letter also needs a new block; Example 2 → 0 instead of 6.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer from k blocks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k', 'next' => 'wrong_b'],
                ['label' => '3k − n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each block needs three letters; Example 1 → 1 instead of 2.\nStep back to when you returned k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
