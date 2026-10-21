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
            'message' => "Read the problem statement above.\nWhich indices can be the best start i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those whose value is smaller than everything before them', 'next' => 's2'],
                ['label' => 'Every index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An earlier, smaller value always gives a wider ramp.\nStep back to when you kept every index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Scan j in which direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the left', 'next' => 'wrong_b'],
                ['label' => 'From the right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. From the right, the first j that fits a start gives its widest ramp.\nStep back to when you scanned from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "nums[stack top] ≤ nums[j]. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record j − top and pop', 'next' => 'success'],
                ['label' => 'Record and keep it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Smaller j values only give that start narrower ramps.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [6,0,8,2,1,5] → 4. [9,8,1,0,1,9,4,0,4,1] → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
