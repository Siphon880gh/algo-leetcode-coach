You get an array of asynchronous functions (each takes no arguments and returns a promise) and a pool limit n. Return a promise that runs them in order with at most n pending at any moment, starting the next one as soon as one finishes, and resolves when all have finished. The exact limits are in the official statement. For instance, functions that take 300, 400 and 200 ms finish after 500 ms with n = 2, after 900 ms with n = 1, and after 400 ms with n = 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Refill on finish

1. `i = 0` (next to start), `running = 0`.
2. `next()`: if every function has started and `running = 0`, resolve. Otherwise, while `running < n` and functions remain, start `functions[i++]`, `running++`, and on its completion `running−−` and call `next()`.
3. Call `next()` once; an empty array resolves immediately.

Constructed checks (run in Node with real timers, a few tens of ms of jitter aside): the cases above → 500, 900, 400 ms.

A shorter form starts n workers that each loop await functions[i++]() until none remain, then awaits all workers.

Time: as long as the schedule takes  
Space: O(n) pending promises

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
