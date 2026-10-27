Given a function that reports its result through a callback, return a function that takes the same other arguments and returns a promise instead: it resolves with the result, or rejects if the callback reports an error. Where the callback goes in the argument list and how it reports errors are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Promisify

1. Return `(...args) => new Promise((resolve, reject) => …)`.
2. Inside, call the original with the remaining args and a callback wired the way the statement describes. For example, with the callback first and called as (data, error): `fn((data, err) => err ? reject(err) : resolve(data), ...args)`.

Constructed checks (run in Node, with that convention): a sum function → 3 for (1, 2), and rejects with its error message for a negative input.

Handle the error path: a callback that only resolves leaves the failing call resolved with undefined instead of rejected.

Time: O(1) besides the function  
Space: O(1)

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
