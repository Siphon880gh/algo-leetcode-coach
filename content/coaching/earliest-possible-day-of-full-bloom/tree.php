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
            'message' => "Read the problem statement above.\nWhat can overlap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Growing, never planting', 'next' => 's2'],
                ['label' => 'Planting of several seeds at once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You work on one seed per day.\nStep back to when you planted in parallel.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Plant order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'plantTime ascending', 'next' => 'wrong_b'],
                ['label' => 'growTime descending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 in plantTime order finishes on day 11, not 9.\nStep back to when you sorted by plantTime.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Finish day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max over seeds of (planting done so far + growTime)', 'next' => 'success'],
                ['label' => 'Total planting + largest growTime', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The largest grower is planted first, so it does not start after everything else; Example 1 would give 8 + 3 = 11 instead of 9.\nStep back to when you added the largest growTime at the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 9, 9, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
