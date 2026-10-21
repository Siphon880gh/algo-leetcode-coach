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
            'message' => "Read the problem statement above.\nA correction for an existing timestamp?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overwrite the map; push new heap entries', 'next' => 's2'],
                ['label' => 'Push to the heaps and leave the map alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The map is the source of truth for detecting stale entries.\nStep back to when you skipped the map update.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The heap top no longer matches the map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it anyway', 'next' => 'wrong_b'],
                ['label' => 'Pop it and look again', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After update(1, 3) the maximum is 5, not the stale 10.\nStep back to when you returned a stale top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "current()?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Price at the largest timestamp', 'next' => 'success'],
                ['label' => 'Price from the most recent update call', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. update(1, 3) after update(2, 5) leaves current at 5.\nStep back to when you used the last call.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) amortised. Example → 5, 10, 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
