Given an array of functions that each return a promise, start them all and return a promise for an array describing each outcome in input order: whether it fulfilled, with its value, or rejected, with its reason. This is Promise.allSettled, which you implement yourself. The exact field names are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Settle by index

1. `out = new Array(n)`, `left = n`; resolve at once with [] if n = 0.
2. For each i: `fns[i]().then(v => out[i] = fulfilled with v, e => out[i] = rejected with e)`, then `if (--left === 0) resolve(out)`.

Constructed checks (run in Node): one function resolving 1 after 20 ms and one rejecting with e after 10 ms → [fulfilled 1, rejected e], the same as Promise.allSettled.

Pushing results as they arrive orders them by finish time: the same check → [rejected e, fulfilled 1]. Promise.all rejects as soon as one rejects.

Time: O(n) plus the slowest promise  
Space: O(n)

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
