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
            'message' => "Problem: Users join with chunks and get an id (as the statement specifies, typically the smallest available, reusing freed ids), leave, and request a chunk; a request returns the sorted owners, and the requester gains the chunk if any owner exists. (Restated from memory; limits and examples may differ slightly.)\nReuse ids how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min-heap of freed ids', 'next' => 's2'],
                ['label' => 'Scan from 1 each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning grows linearly.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Request with owners found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No change', 'next' => 'wrong_b'],
                ['label' => 'Requester gains the chunk', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement grants it.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "On leave?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove the id from all its chunks, then free it', 'next' => 'success'],
                ['label' => 'Only free the id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stale owners would appear in results.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Heap ids, owner sets, and cleanup on leave.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
