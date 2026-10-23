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
            'message' => "Read the problem statement above.\nPer row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its limits[i] largest values', 'next' => 's2'],
                ['label' => 'All of its values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 with limits = [1, 1] → 7 instead of 6.\nStep back to when you ignored the limits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest value of each row', 'next' => 'wrong_b'],
                ['label' => 'The k largest kept values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 15 instead of 21.\nStep back to when you took one per row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(nm log(nm)). Examples → 7, 21.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
