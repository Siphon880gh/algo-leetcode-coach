A street has positions 0 … n − 1. Each light [position, range] lights every position from position − range to position + range, clipped to the street, adding 1 brightness there. Given requirement[i] for each position, return how many positions have brightness at least their requirement. For instance, n = 5, lights [[0,1],[2,1],[3,2]], requirement [0,2,1,4,1] → 4; n = 1, lights [[0,1]], requirement [2] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Range adds in O(1)

1. `d[max(0, p − r)] += 1`, `d[min(n − 1, p + r) + 1] −= 1` for each light.
2. Running sum gives brightness; count `i` with brightness ≥ `requirement[i]`.

Constructed checks (computed with this method): the two cases above → 4, 0.

Clipping before writing keeps every index inside the array.

Time: O(n + lights)  
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
