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
            'message' => "Read the problem statement above.\nGaps between positions include?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The wrap-around one', 'next' => 's2'],
                ['label' => 'Only gaps inside the array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A single copy looks free; example 2 → 0 instead of 2.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A gap of g takes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'g − 1 seconds', 'next' => 'wrong_b'],
                ['label' => 'g // 2 seconds', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It fills from both sides; example 2 → 3 instead of 2.\nStep back to when you used g − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
