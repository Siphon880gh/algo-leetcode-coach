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
            'message' => "Problem: Boxes are pushed into rooms from the left only; a box stops before a lower room; no stacking; boxes may be reordered. Return the maximum number placed. For instance, boxes [4,3,4,1] with rooms [5,3,3,4,1] → 3. (Restated from memory; limits and examples may differ slightly.)\nRoom heights to use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix minimum from the entrance', 'next' => 's2'],
                ['label' => 'Raw heights', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A low room blocks everything behind it.\nStep back to when you used raw heights.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fill order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Front rooms first with big boxes', 'next' => 'wrong_b'],
                ['label' => 'Back rooms first with small boxes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Front boxes would block the back.\nStep back to when you filled the front first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Box does not fit a room?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the room, keep the box', 'next' => 'success'],
                ['label' => 'Discard the box', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A room nearer the entrance may be taller.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m). Example → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
