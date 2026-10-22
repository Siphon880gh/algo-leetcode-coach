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
            'message' => "Read the problem statement above.\nnum ≠ value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reset the run to 0', 'next' => 's2'],
                ['label' => 'Keep the count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The run must be unbroken; value = 4, k = 3, stream 4, 4, 3, 4 → last call true instead of false.\nStep back to when you kept the count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return true when the run is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly k', 'next' => 'wrong_b'],
                ['label' => '≥ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Longer runs still end in k matches; value = 4, k = 3, stream 4, 4, 4, 4 → last call false instead of true.\nStep back to when you used =.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Example → [null, false, false, true, false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
