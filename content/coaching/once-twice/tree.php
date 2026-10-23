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
            'message' => "Problem: Every value in an array appears exactly three times, except one value that appears once and another that appears twice. Return [the value that appears once, the value that appears twice]. The intended solution uses linear time and constant extra space. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRead the once-value straight from count mod 3 = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, split on a bit first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 7, 7, 5, 5, 5] → 0 instead of 3.\nStep back to when you read it directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Split bit d has count mod 3 = 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The half with bit d holds it anyway', 'next' => 'wrong_b'],
                ['label' => 'The half without bit d holds the once-value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 1, 1, 4, 4, 4] → [1, 2] instead of [2, 1].\nStep back to when you ignored the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · B). Checks → [3, 7], [1, 2], [2, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
