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
            'message' => "Read the problem statement above.\nThief distances from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One BFS from all thieves', 'next' => 's2'],
                ['label' => 'A BFS from each thief', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is O(n²) per thief, up to O(n⁴) for n = 400.\nStep back to when you ran one BFS per thief.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Expand which cell first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest (min-heap)', 'next' => 'wrong_b'],
                ['label' => 'The largest path value (max-heap)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You settle for unsafe routes; example 2 → 0 instead of 2.\nStep back to when you used a min-heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log n). Examples → 0, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
