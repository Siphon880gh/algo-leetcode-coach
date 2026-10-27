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
            'message' => "Read the problem statement above.\nLeft-rotating nums[l..r] does what to the signs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing changes; only the order inside moves', 'next' => 'wrong_a'],
                ['label' => 'a[l + 1..r] each flip sign, and a[l] takes the sign of position r', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Rotating [1, 5] to [5, 1] changes the pulse from −2 to 6 in Example 1.\nStep back to when you assumed the signs stay.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 3:\nnums = [9, 7]\nthe only rotation gives [7, 9], pulse −2\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−2, a rotation is required', 'next' => 'wrong_b'],
                ['label' => '2, skip the rotation', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The operation is at most once. Forcing it gives −2 instead of 2.\nStep back to when you forced the rotation.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Gain = term in l + term in r, scanned once. O(n). Examples give 6, 7 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
