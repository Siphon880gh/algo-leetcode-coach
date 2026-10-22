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
            'message' => "Read the problem statement above.\nScanning hits a used cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the run to 0', 'next' => 's2'],
                ['label' => 'Keep the run going', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A block must be consecutive free cells; the example’s allocate(3, 4) → 2 instead of 3.\nStep back to when you kept the run.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "freeMemory(mID) clears?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only its most recent block', 'next' => 'wrong_b'],
                ['label' => 'Every cell owned by mID', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An mID can own several blocks; the example’s freeMemory(1) → 1 instead of 3.\nStep back to when you freed one block.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) per call. Example → [null, 0, 1, 2, 1, 3, 1, 6, 3, −1, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
