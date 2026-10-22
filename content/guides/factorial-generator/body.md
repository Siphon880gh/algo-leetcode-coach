Write a generator that, given n, yields the factorials 1!, 2!, …, n! in order. How n = 0 is handled and the limits are in the official statement. For instance, n = 5 yields 1, 2, 6, 24, 120. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Running product

1. `p = 1`.
2. For i = 1 … n: `p *= i`; `yield p`.
3. Handle n = 0 the way the statement says.

Constructed checks (run in Node): n = 5 → 1, 2, 6, 24, 120; n = 2 → 1, 2.

Start the product at 1, not 0: from 0 every value stays 0. Recomputing each factorial from scratch costs O(n²) multiplications.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
