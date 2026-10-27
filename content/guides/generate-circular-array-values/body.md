Write a generator over an array that starts at a given index and yields the element there. Each value passed into next moves the index by that many steps around the array, wrapping in both directions, and the generator then yields the new element. The exact signature and limits are in the official statement. For instance, with [1, 2, 3, 4, 5] starting at index 0, jumps 1, 2, 6 and −6 yield 1, then 2, 4, 5 and 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Yield and jump

1. `while (true) { const j = yield arr[i]; i = ((i + j) % n + n) % n; }`

Constructed check (run in Node): the example above → 1, 2, 4, 5, 4.

JavaScript’s % keeps the sign of the left side, so a plain `(i + j) % n` with jump −2 from index 0 gives −2 and yields undefined instead of 4.

Time: O(1) per step  
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
