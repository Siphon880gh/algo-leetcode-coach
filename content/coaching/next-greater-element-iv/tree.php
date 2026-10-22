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
            'message' => "Read the problem statement above.\nSettle the second stack when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before moving entries over from the first', 'next' => 's2'],
                ['label' => 'After moving them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x then counts as both first and second greater; [1,2] → [2,−1] instead of [−1,−1].\nStep back to when you settled after moving.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Push the moved block in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order they were popped', 'next' => 'wrong_b'],
                ['label' => 'Original order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second stack loses its order; [1,0,2,1] → [−1,−1,−1,−1] instead of [−1,1,−1,−1].\nStep back to when you reversed the block.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [9,6,6,−1,−1], [−1,−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
