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
            'message' => "Problem: Implement a thread-safe bounded queue with a given capacity: enqueue(x) adds an element, blocking while the queue is full; dequeue() removes the oldest element, blocking while the queue is empty; and size() returns the number of elements. (Restated from memory; limits and examples may differ slightly.)\nWait with if or while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'while: re-check after waking', 'next' => 's2'],
                ['label' => 'if', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Spurious wakeups and other threads can change the queue.\nStep back to when you used if.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After enqueue, notify which condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'not_full', 'next' => 'wrong_b'],
                ['label' => 'not_empty', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A waiting dequeuer needs to know an element arrived.\nStep back to when you notified not_full.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Busy-wait in a loop instead?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use condition variables', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Spinning wastes CPU.\nStep back to when you spun.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per operation plus waiting. FIFO order, blocking at both bounds.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
