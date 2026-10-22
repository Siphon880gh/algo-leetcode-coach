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
            'message' => "Problem: You are given a pattern of bits and an infinite stream of bits that you read one at a time through an interface the statement provides. Return the first index at which the pattern appears in the stream. Interface names and limits are in the official statement. For instance, a stream starting 1, 1, 1, 0, 1 with pattern [0, 1] → 3. (Restated from memory; limits and examples may differ slightly.)\nOn a mismatch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fall back with the failure table', 'next' => 's2'],
                ['label' => 'Restart the match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Stream 1, 1, 1, 0 with pattern [1, 1, 0] finds nothing instead of index 1.\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return at a full match on bit i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i', 'next' => 'wrong_b'],
                ['label' => 'i − |p| + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The example → 4 instead of 3.\nStep back to when you returned i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(answer + |p|). The example → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
