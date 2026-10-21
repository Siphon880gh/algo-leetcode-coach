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
            'message' => "Problem: Given a 0-indexed array nums of length n, each minute one element is removed from the front until the array is empty; then each minute the elements are appended back in their original order until nums is whole again, and the process repeats. For each query [time, index], return the element at that index after time minutes, or −1 if the index does not exist then. For instance, nums = [0,1,2] with queries [0,2], [2,0], [3,2], [5,0] → [2,2,−1,0]; nums = [2] with queries [0,0], [1,0], [2,0], [3,0] → [2,−1,2,−1]. (Restated from memory; limits and examples may differ slightly.)\nThe state repeats every?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2n minutes', 'next' => 's2'],
                ['label' => 'n minutes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. nums = [2] is empty at minute 1, but time mod 1 = 0 would say [2].\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "During removal (t < n), index j holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[j]', 'next' => 'wrong_b'],
                ['label' => 'nums[t + j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. t elements are gone from the front; [0,1,2] at minute 2 is [2], so index 0 holds 2.\nStep back to when you ignored the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "During refill (t ≥ n), index j exists when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j < t − n', 'next' => 'success'],
                ['label' => 'j ≤ t − n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. At t = n the array is still empty; [0,1,2] at minute 3, index 0 → −1.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per query. Constructed checks → [2,2,-1,0], [2,-1,2,-1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
