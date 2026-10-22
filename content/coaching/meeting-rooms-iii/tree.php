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
            'message' => "Read the problem statement above.\nA delayed meeting now ends at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The room’s free time + (end − start)', 'next' => 's2'],
                ['label' => 'Its original end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It keeps its duration; Example 1 → 1 instead of 0.\nStep back to when you kept the original end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A room is free for a meeting starting at s when its end is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '< s', 'next' => 'wrong_b'],
                ['label' => '≤ s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Meetings are half-open; n = 2, meetings = [[4,7],[7,9],[9,13],[10,12],[11,12]] → 1 instead of 0.\nStep back to when you required < s.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rooms tie on count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the lowest room', 'next' => 'success'],
                ['label' => 'Return the highest room', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In Example 1 both rooms hold two meetings → 1 instead of 0.\nStep back to when you took the highest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m + m log n). Examples → 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
