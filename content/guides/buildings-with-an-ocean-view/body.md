Given building heights in a line with the ocean to the right, a building has an ocean view if every building to its right is strictly shorter. Return the indices with a view in increasing order. For instance, [4,2,3,1] → [0,2,3], [1,3,2,4] → [3], and [2,2,2] → [2]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Running maximum from the right

1. `best = −∞`, `out = []`.
2. For `i` from `n − 1` down to 0: if `h[i] > best`, append `i` and set `best = h[i]`.
3. Return `out` reversed.

Constructed checks (verified by brute force): `[4,2,3,1]` → `[0,2,3]`, `[4,3,2,1]` → `[0,1,2,3]`, `[1,3,2,4]` → `[3]`, `[2,2,2]` → `[2]`.

Use a strict `>`: an equal building to the right blocks the view.

Time: O(n)  
Space: O(1) besides the output

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
