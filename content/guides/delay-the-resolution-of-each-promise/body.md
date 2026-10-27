Given an array of functions that return promises and a delay in milliseconds, return new functions whose promises settle the same way as the originals, only that much later. Whether rejections are delayed too and the limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Wrap each

This delays both outcomes; drop the reject branch if the statement says rejections pass through at once.

1. Map each f to `() => new Promise((res, rej) => f().then(v => setTimeout(() => res(v), ms), e => setTimeout(() => rej(e), ms)))`.

Constructed checks (run in Node, ms = 50): a function resolving 1 after 30 ms → 1; one rejecting with e after 10 ms → rejected with e, after about 60 ms.

Delaying only the then branch lets that rejection through after about 10 ms.

Time: O(n) to build  
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
