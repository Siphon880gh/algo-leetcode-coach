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
            'message' => "Problem: LogSystem: put(id, timestamp) with timestamps like \"2017:01:01:23:59:59\", and retrieve(start, end, granularity) returning the ids whose timestamp falls in [start, end] when compared only down to the granularity (Year, Month, Day, Hour, Minute or Second). (Restated from memory; limits and examples may differ slightly.)\nHow do you compare two timestamps at a granularity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare their prefixes up to that field as strings', 'next' => 's2'],
                ['label' => 'Compare the full strings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. At Day granularity, a log late on the end day must still count, but the full string puts it after end.\nStep back to when you compared full strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the prefix length for Hour?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '11 characters', 'next' => 'wrong_b'],
                ['label' => '13 characters: YYYY:MM:DD:HH', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. YYYY:MM:DD:HH is 13 characters; 11 cuts into the hour.\nStep back to when you used 11.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the range test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'start[:k] ≤ ts[:k] ≤ end[:k], inclusive at both ends', 'next' => 'success'],
                ['label' => 'start[:k] < ts[:k] < end[:k]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The range includes both ends.\nStep back to when you used strict comparisons.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fixed prefix lengths per granularity and inclusive string comparison: O(1) put, O(n) retrieve.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
