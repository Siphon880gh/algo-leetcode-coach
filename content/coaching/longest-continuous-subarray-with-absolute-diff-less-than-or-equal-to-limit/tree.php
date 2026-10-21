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
            'message' => "Read the problem statement above.\nTrack window max and min?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two monotonic deques', 'next' => 's2'],
                ['label' => 'Recompute each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrinking the left end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clear the deques', 'next' => 'wrong_b'],
                ['label' => 'Pop deque fronts equal to nums[l]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later elements are still in the window.\nStep back to when you cleared them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal values in the deques?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them (pop only strict)', 'next' => 'success'],
                ['label' => 'Pop equals too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Removing by nums[l] == front would then drop a copy still in the window.\nStep back to when you popped equals.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [8,2,4,7], 4 → 2. [10,1,2,4,7,2], 5 → 4. [4,2,2,2,4,4,2,2], 0 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
