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
            'message' => "Problem: Starting at index 0, you hop forward to later indices until you reach the last index. Each hop earns a score that depends on its length and the value where it lands, as the statement defines it. Return the largest total score. This version has larger limits than part I; they are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nUnit step k pays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(nums[k …])', 'next' => 's2'],
                ['label' => 'nums[k]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the guide’s assumption [4, 5, 2, 8, 9, 1, 3] → 28 instead of 42.\nStep back to when you paid nums[k].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … n − 1', 'next' => 'wrong_b'],
                ['label' => '1 … n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Index 0 is the start: [1, 5, 8] → 24 instead of 16.\nStep back to when you included 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 16, 42.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
