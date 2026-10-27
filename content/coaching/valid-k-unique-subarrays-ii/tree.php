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
            'message' => "Problem: You get nums (length n), k, a first query [l0, r0], and a query count q. A subarray is valid when it has exactly k distinct values and every value in it appears an even number of times. Queries are made one at a time: after answering query i, let g = l + r if it was valid and g = r − l otherwise; the next query is l' = (l XOR g) mod n and r' = (r XOR g) mod n, swapped if l' > r'. Return the q answers as booleans. Example: nums = [1, 2, 2, 1], k = 2, l0 = 1, r0 = 2, q = 2 gives [false, true]. n and q go up to 5 × 10^5.\nQueries arrive one at a time. How do you handle them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort them and sweep offline', 'next' => 'wrong_a'],
                ['label' => 'Answer each one before building the next', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Query i + 1 is built from answer i, so the later queries do not exist up front.\nStep back to when you planned an offline sweep.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 1, query [2, 2]:\ncounts = {2: 2}\nk = 2\nIs it valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, every count is even', 'next' => 'wrong_b'],
                ['label' => 'No, it needs exactly 2 distinct values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Checking only even counts gives [true, true] for Example 1 instead of [false, true].\nStep back to when you skipped the distinct count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Use a prefix XOR hash for even counts and a persistent segment tree over prev for the distinct count. O((n + q) log n). Examples give [false, true] and [true, false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
